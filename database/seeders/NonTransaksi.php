<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NonTransaksi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //user
        DB::statement("DROP PROCEDURE IF EXISTS create_user;");
        DB::statement('
            CREATE PROCEDURE create_user(
                IN p_username VARCHAR(45),
                IN p_password VARCHAR(100),
                IN p_idrole INT
            )
            BEGIN
                INSERT INTO user (username, password, idrole)
                VALUES (p_username, p_password, p_idrole);
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS update_user;");
        DB::statement('
            CREATE PROCEDURE update_user(
                IN p_iduser INT,
                IN p_username VARCHAR(45),
                IN p_password VARCHAR(100),
                IN p_idrole INT
            )
            BEGIN
                UPDATE user
                SET username = p_username, password = p_password, idrole = p_idrole
                WHERE iduser = p_iduser;
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS delete_user;");
        DB::statement('
            CREATE PROCEDURE delete_user(
                IN p_iduser INT
            )
            BEGIN
                DELETE FROM user
                WHERE iduser = p_iduser;
            END;
        ');

        //role
        DB::statement("DROP PROCEDURE IF EXISTS create_role;");
        DB::statement('
            CREATE PROCEDURE create_role(
                IN p_nama_role VARCHAR(100)
            )
            BEGIN
                INSERT INTO role (nama_role)
                VALUES (p_nama_role);
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS update_role;");
        DB::statement('
            CREATE PROCEDURE update_role(
                IN p_idrole INT,
                IN p_nama_role VARCHAR(100)
            )
            BEGIN
                UPDATE role
                SET nama_role = p_nama_role
                WHERE idrole = p_idrole;
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS delete_role;");
        DB::statement('
            CREATE PROCEDURE delete_role(
                IN p_idrole INT
            )
            BEGIN
                DELETE FROM role
                WHERE idrole = p_idrole;
            END;
        ');

        //vendor
        DB::statement("DROP PROCEDURE IF EXISTS create_vendor;");
        DB::statement('
            CREATE PROCEDURE create_vendor(
                IN p_nama_vendor VARCHAR(100),
                IN p_badan_hukum CHAR(1),
                IN p_status CHAR(1)
            )
            BEGIN
                INSERT INTO vendor (nama_vendor, badan_hukum, status)
                VALUES (p_nama_vendor, p_badan_hukum, p_status);
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS update_vendor;");
        DB::statement('
            CREATE PROCEDURE update_vendor(
                IN p_idvendor INT,
                IN p_nama_vendor VARCHAR(100),
                IN p_badan_hukum CHAR(1),
                IN p_status CHAR(1)
            )
            BEGIN
                UPDATE vendor
                SET nama_vendor = p_nama_vendor,
                    badan_hukum = p_badan_hukum,
                    status = p_status
                WHERE idvendor = p_idvendor;
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS delete_vendor;");
        DB::statement('
            CREATE PROCEDURE delete_vendor(
                IN p_idvendor INT
            )
            BEGIN
                DELETE FROM vendor
                WHERE idvendor = p_idvendor;
            END;
        ');

        //barang
        DB::statement("DROP PROCEDURE IF EXISTS create_barang;");
        DB::statement('
            CREATE PROCEDURE create_barang(
                IN p_nama VARCHAR(45),
                IN p_jenis CHAR(1),
                IN p_nama_satuan VARCHAR(45),
                IN p_status TINYINT,
                IN p_harga INT
            )
            BEGIN
                INSERT INTO barang (nama, jenis,  status, harga)
                VALUES (p_nama, p_jenis,  p_status, p_harga);
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS update_barang;");
        DB::statement('
            CREATE PROCEDURE update_barang(
                IN p_idbarang INT,
                IN p_nama VARCHAR(45),
                IN p_jenis CHAR(1),
                IN p_status TINYINT,
                IN p_harga INT
            )
            BEGIN
                UPDATE barang
                SET nama = p_nama,
                    jenis = p_jenis,
                    status = p_status,
                    harga = p_harga
                WHERE idbarang = p_idbarang;
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS delete_barang;");
        DB::statement('
            CREATE PROCEDURE delete_barang(
                IN p_idbarang INT
            )
            BEGIN
                DELETE FROM barang
                WHERE idbarang = p_idbarang;
            END;
        ');

        //satuan
        DB::statement("DROP PROCEDURE IF EXISTS create_satuan;");
        DB::statement('
            CREATE PROCEDURE create_satuan(
                IN p_nama_satuan VARCHAR(45),
                IN p_status TINYINT
            )
            BEGIN
                INSERT INTO satuan (nama_satuan, status)
                VALUES (p_nama_satuan, p_status);
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS update_satuan;");
        DB::statement('
            CREATE PROCEDURE update_satuan(
                IN p_idsatuan INT,
                IN p_nama_satuan VARCHAR(45),
                IN p_status TINYINT
            )
            BEGIN
                UPDATE satuan
                SET nama_satuan = p_nama_satuan,
                    status = p_status
                WHERE idsatuan = p_idsatuan;
            END;
        ');

        DB::statement("DROP PROCEDURE IF EXISTS delete_satuan;");
        DB::statement('
            CREATE PROCEDURE delete_satuan(
                IN p_idsatuan INT
            )
            BEGIN
                DELETE FROM satuan
                WHERE idsatuan = p_idsatuan;
            END;
        ');
    }
}