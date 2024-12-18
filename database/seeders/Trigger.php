<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Trigger extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_update_kartu_stok;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_insert_penerimaan;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_insert_retur;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_insert_penjualan;");

        DB::unprepared("
            CREATE TRIGGER after_insert_penerimaan
            AFTER INSERT ON detail_penerimaan
            FOR EACH ROW
            BEGIN
                DECLARE current_stock DECIMAL(10,2) DEFAULT 0;

                SELECT COALESCE(stock, 0) INTO current_stock
                FROM kartu_stok
                WHERE idbarang = NEW.idbarang
                ORDER BY idkartu_stok DESC
                LIMIT 1;

                INSERT INTO kartu_stok (idbarang, created_at, masuk, stock, jenis_transaksi, idtransaksi)
                VALUES (NEW.idbarang, NOW(), NEW.jumlah_terima, current_stock + 1500, 'p', NEW.idpenerimaan);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER after_insert_retur
            AFTER INSERT ON detail_retur
            FOR EACH ROW
            BEGIN
                DECLARE current_stock DECIMAL(10,2) DEFAULT 0;
                DECLARE id_barang INT;

                SELECT idbarang INTO id_barang
                FROM detail_penerimaan
                WHERE iddetail_penerimaan = NEW.iddetail_penerimaan
                LIMIT 1;

                IF id_barang IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'ID Barang tidak ditemukan untuk retur.';
                END IF;

                SELECT COALESCE(stock, 0) INTO current_stock
                FROM kartu_stok
                WHERE idbarang = id_barang
                ORDER BY idkartu_stok DESC
                LIMIT 1;

                IF current_stock < NEW.jumlah THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Stok tidak mencukupi untuk retur.';
                END IF;

                INSERT INTO kartu_stok (idbarang, created_at, keluar, stock, jenis_transaksi, idtransaksi)
                VALUES (id_barang, NOW(), NEW.jumlah, current_stock - NEW.jumlah, 'r', NEW.idretur);
            END
        ");

        DB::unprepared("
        CREATE TRIGGER after_insert_penjualan
        BEFORE INSERT ON detail_penjualan
        FOR EACH ROW
        BEGIN
            DECLARE current_stock DECIMAL(10,2) DEFAULT 0;
    
            -- Ambil stok terakhir dari kartu_stok, jika tidak ada set ke 0
            SELECT COALESCE(stock, 0) INTO current_stock
            FROM kartu_stok
            WHERE idbarang = NEW.idbarang
            ORDER BY idkartu_stok DESC
            LIMIT 1;
    
            -- Cek apakah stok mencukupi
            IF current_stock < NEW.jumlah THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak mencukupi';
            END IF;
    
            -- Jika stok mencukupi, update kartu_stok dan insert detail penjualan
            INSERT INTO kartu_stok (idbarang, created_at, keluar, stock, jenis_transaksi, idtransaksi)
            VALUES (NEW.idbarang, NOW(), NEW.jumlah, current_stock - NEW.jumlah, 's', NEW.penjualan_idpenjualan);
        END
    ");
    }
}