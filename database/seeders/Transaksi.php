<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Transaksi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Drop existing procedures and triggers first
        DB::unprepared('DROP PROCEDURE IF EXISTS CreatePengadaan');
        DB::unprepared('DROP PROCEDURE IF EXISTS CreatePenerimaan');
        DB::unprepared('DROP PROCEDURE IF EXISTS CreatePenjualan');
        DB::unprepared('DROP PROCEDURE IF EXISTS CreateRetur');

        // Procedure untuk membuat pengadaan
        DB::unprepared("
        CREATE PROCEDURE CreatePengadaan(
            IN p_vendor_id INT,
            IN p_user_id INT,
            IN p_items JSON
        )
        BEGIN
            DECLARE pengadaan_id BIGINT;
            
            -- Insert header pengadaan
            INSERT INTO pengadaan (
                timestamp,
                iduser,
                vendor_idvendor,
                status,
                subtotal_nilai,
                ppn,
                total_nilai
            ) VALUES (
                NOW(),
                p_user_id,
                p_vendor_id,
                '0', -- '0' untuk status pending
                0,
                0,
                0
            );
            
            SET pengadaan_id = LAST_INSERT_ID();
            
            -- Insert detail pengadaan from JSON
            INSERT INTO detail_pengadaan (
                idpengadaan,
                idbarang,
                jumlah,
                harga_satuan,
                sub_total
            )
            SELECT 
                pengadaan_id,
                barang_id,
                jumlah,
                (SELECT harga FROM barang WHERE idbarang = barang_id) AS harga_satuan,
                jumlah * (SELECT harga FROM barang WHERE idbarang = barang_id)
            FROM (
                SELECT 
                    CAST(JSON_EXTRACT(item, '$.barang_id') AS UNSIGNED) AS barang_id,
                    COALESCE(CAST(JSON_EXTRACT(item, '$.jumlah') AS UNSIGNED), 0) AS jumlah
                FROM JSON_TABLE(p_items, '$[*]' COLUMNS (
                    item JSON PATH '$'
                )) AS items
            ) AS parsed_items;
            
            -- Update totals
            UPDATE pengadaan 
            SET subtotal_nilai = (
                SELECT SUM(sub_total) 
                FROM detail_pengadaan 
                WHERE idpengadaan = pengadaan_id
            ),
            ppn = (SELECT SUM(sub_total) FROM detail_pengadaan WHERE idpengadaan = pengadaan_id) * 0.11,
            total_nilai = (
                SELECT SUM(sub_total) * 1.11
                FROM detail_pengadaan 
                WHERE idpengadaan = pengadaan_id
            )
            WHERE idpengadaan = pengadaan_id;
        END
    ");

        DB::unprepared("
        CREATE PROCEDURE CreatePenerimaan(
            IN p_barang_id INT,
            IN p_user_id INT,
            IN p_jumlah_terima INT,
            IN p_idpengadaan INT
        )
        BEGIN
            DECLARE penerimaan_id INT;
            DECLARE harga_satuan INT DEFAULT 0;
            DECLARE sub_total_terima INT DEFAULT 0;
            DECLARE jumlah_pengadaan INT DEFAULT 0;

            -- Ambil jumlah dari detail_pengadaan
            SELECT jumlah
            INTO jumlah_pengadaan
            FROM detail_pengadaan
            WHERE idbarang = p_barang_id AND idpengadaan = p_idpengadaan
            LIMIT 1;

            -- Validasi data
            IF jumlah_pengadaan IS NULL THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Data barang atau pengadaan tidak ditemukan.';
            END IF;

            -- Validasi jumlah cukup di pengadaan
            IF jumlah_pengadaan < p_jumlah_terima THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Jumlah terima melebihi jumlah pengadaan.';
            END IF;

            -- Ambil harga_satuan dari tabel barang
            SELECT harga
            INTO harga_satuan
            FROM barang
            WHERE idbarang = p_barang_id
            LIMIT 1;

            -- Validasi harga barang
            IF harga_satuan IS NULL THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Harga barang tidak ditemukan.';
            END IF;

            -- Hitung subtotal
            SET sub_total_terima = p_jumlah_terima * COALESCE(harga_satuan, 0);

            -- Insert ke tabel penerimaan (header)
            INSERT INTO penerimaan (
                created_at,
                status,
                idpengadaan,
                iduser
            ) VALUES (
                NOW(),
                '0', -- Status awal (misal: '0' untuk pending)
                p_idpengadaan,
                p_user_id
            );

            -- Ambil ID penerimaan terakhir
            SET penerimaan_id = LAST_INSERT_ID();

            -- Insert ke tabel detail_penerimaan
            INSERT INTO detail_penerimaan (
                idbarang,
                jumlah_terima,
                harga_satuan,
                sub_total_terima,
                idpenerimaan
            ) VALUES (
                p_barang_id,
                p_jumlah_terima,
                harga_satuan,
                sub_total_terima,
                penerimaan_id
            );

            -- Update jumlah di tabel detail_pengadaan
            UPDATE detail_pengadaan
            SET jumlah = jumlah - p_jumlah_terima
            WHERE idbarang = p_barang_id AND idpengadaan = p_idpengadaan;

            -- Jika jumlah pengadaan sudah habis, update status
            IF (SELECT SUM(jumlah) FROM detail_pengadaan WHERE idpengadaan = p_idpengadaan) = 0 THEN
                UPDATE pengadaan
                SET status = '1' -- '1' untuk status selesai
                WHERE idpengadaan = p_idpengadaan;
            END IF;

        END
    ");
        
        DB::unprepared("
            CREATE PROCEDURE CreatePenjualan(
                IN p_user_id INT,
                IN p_items JSON
            )
            BEGIN
                DECLARE penjualan_id BIGINT;
                DECLARE total_subtotal DECIMAL(10, 2) DEFAULT 0;
                DECLARE total_margin DECIMAL(10, 2) DEFAULT 0;
                DECLARE total_ppn DECIMAL(10, 2) DEFAULT 0;
                DECLARE total_nilai DECIMAL(10, 2) DEFAULT 0;

                -- Insert header penjualan
                INSERT INTO penjualan (
                    created_at,
                    iduser,
                    total_nilai,
                    subtotal_nilai,
                    ppn,
                    idmargin_penjualan
                ) VALUES (
                    NOW(),
                    p_user_id,
                    0, -- sementara 0, akan diupdate setelah detail diinput
                    0,
                    0,
                    (SELECT idmargin_penjualan FROM margin_penjualan WHERE status = 1 LIMIT 1)
                );

                SET penjualan_id = LAST_INSERT_ID();

                -- Insert detail penjualan dari JSON
                INSERT INTO detail_penjualan (
                    penjualan_idpenjualan,
                    idbarang,
                    jumlah,
                    harga_satuan,
                    subtotal
                )
                SELECT 
                    penjualan_id,
                    barang_id,
                    jumlah,
                    (SELECT harga FROM barang WHERE idbarang = barang_id) AS harga_satuan,
                    jumlah * (SELECT harga FROM barang WHERE idbarang = barang_id)
                FROM (
                    SELECT 
                        CAST(JSON_EXTRACT(item, '$.barang_id') AS UNSIGNED) AS barang_id,
                        COALESCE(CAST(JSON_EXTRACT(item, '$.jumlah') AS UNSIGNED), 0) AS jumlah
                    FROM JSON_TABLE(p_items, '$[*]' COLUMNS (
                        item JSON PATH '$'
                    )) AS items
                ) AS parsed_items;

                -- Hitung total subtotal dan margin
                SELECT 
                    SUM(subtotal) INTO total_subtotal
                FROM detail_penjualan
                WHERE penjualan_idpenjualan = penjualan_id;

                SELECT
                    (total_subtotal * (SELECT persen / 100 FROM margin_penjualan WHERE status = 1 LIMIT 1)) INTO total_margin;

                SET total_ppn = total_subtotal * 0.11;
                SET total_nilai = total_subtotal + total_margin + total_ppn;

                -- Update header penjualan
                UPDATE penjualan
                SET subtotal_nilai = total_subtotal,
                    ppn = total_ppn,
                    total_nilai = total_nilai
                WHERE idpenjualan = penjualan_id;

            END
        ");

        DB::unprepared("
        CREATE PROCEDURE CreateRetur(
            IN p_idpenerimaan INT,
            IN p_barang_id INT,
            IN p_user_id INT,
            IN p_jumlah_retur INT,
            IN p_alasan TEXT
        )
        BEGIN
            DECLARE jumlah_terima INT;

            -- Ambil jumlah terima dari tabel detail_penerimaan
            SELECT jumlah_terima INTO jumlah_terima
            FROM detail_penerimaan
            WHERE idbarang = p_barang_id AND idpenerimaan = p_idpenerimaan;

            -- Validasi jumlah cukup untuk diretur
            IF jumlah_terima < p_jumlah_retur THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Jumlah retur melebihi jumlah yang diterima.';
            END IF;

            -- Insert ke tabel retur
            INSERT INTO retur (created_at, idpenerimaan, iduser)
            VALUES (NOW(), p_idpenerimaan, p_user_id);

            -- Insert ke tabel detail_retur
            INSERT INTO detail_retur (jumlah, alasan, idretur, iddetail_penerimaan)
            VALUES (
                p_jumlah_retur,
                p_alasan,
                LAST_INSERT_ID(),
                (
                    SELECT iddetail_penerimaan 
                    FROM detail_penerimaan 
                    WHERE idbarang = p_barang_id AND idpenerimaan = p_idpenerimaan LIMIT 1
                )
            );
        END
        ");
    }
}