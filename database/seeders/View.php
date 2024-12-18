<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class View extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // view_user
        DB::statement('
            CREATE OR REPLACE VIEW view_user AS
            SELECT
                *
            FROM
                user
        ');
        // view_role
        DB::statement('
            CREATE OR REPLACE VIEW view_role AS
            SELECT
                role.idrole,
                role.nama_role
            FROM
                role
        ');

        // view_barang
        DB::statement('
            CREATE OR REPLACE VIEW view_barang AS
            SELECT
                *
            FROM barang
        ');

        // view_satuan
        DB::statement('
            CREATE OR REPLACE VIEW view_satuan AS
            SELECT
               *
            FROM
                satuan
        ');

        // view_vendor
        DB::statement('
            CREATE OR REPLACE VIEW view_vendor AS
            SELECT
               *
            FROM vendor;
        ');

        DB::statement('
        CREATE OR REPLACE VIEW view_pengadaan AS
        SELECT
            pengadaan.*,
            vendor.nama_vendor
        FROM
            pengadaan
        JOIN
            vendor ON pengadaan.vendor_idvendor = vendor.idvendor
        ORDER BY pengadaan.idpengadaan DESC
    ');

    DB::statement('
        CREATE OR REPLACE VIEW view_detailpengadaan AS
        SELECT
            pengadaan.*,
            vendor.nama_vendor
        FROM
            pengadaan
        JOIN
            vendor ON pengadaan.vendor_idvendor = vendor.idvendor
        ORDER BY pengadaan.idpengadaan DESC
    ');

    DB::statement('
        CREATE OR REPLACE VIEW view_detailpengadaan AS
        SELECT 
            detail_pengadaan.*,
            barang.nama
        FROM detail_pengadaan
        JOIN barang ON detail_pengadaan.idbarang = barang.idbarang
    ');

        // view_pengadaan
        // DB::statement('
        //     CREATE OR REPLACE VIEW view_pengadaan AS
        //     SELECT
        //         pengadaan.idpengadaan AS idpengadaan,
        //         pengadaan.timestamp AS timestamp,
        //         user.username AS username,
        //         vendor.nama_vendor AS nama_vendor,
        //         pengadaan.subtotal_nilai AS subtotal_nilai,
        //         pengadaan.ppn AS ppn,
        //         pengadaan.total_nilai AS total_nilai,
        //         pengadaan.status AS status
        //     FROM pengadaan
        //     JOIN user ON pengadaan.iduser = user.iduser
        //     JOIN vendor ON pengadaan.vendor_idvendor = vendor.idvendor;
        // ');

        // // view_penjualan
        DB::statement('
            CREATE OR REPLACE VIEW view_penjualan AS
            SELECT
                penjualan.idpenjualan AS idpenjualan,
                penjualan.created_at AS timestamp,
                user.username AS username,
                penjualan.subtotal_nilai AS subtotal_nilai,
                penjualan.ppn AS ppn,
                penjualan.total_nilai AS total_nilai,
                margin_penjualan.persen AS persen
            FROM penjualan
            JOIN user ON penjualan.iduser = user.iduser
            JOIN margin_penjualan ON penjualan.idmargin_penjualan = margin_penjualan.idmargin_penjualan;
        ');

        // // view_retur
        DB::statement('
            CREATE OR REPLACE VIEW view_retur AS
            SELECT
                retur.idretur AS idretur,
                retur.created_at AS timestamp,
                user.username AS username
            FROM retur
            JOIN user ON retur.iduser = user.iduser;
        ');
    }
}