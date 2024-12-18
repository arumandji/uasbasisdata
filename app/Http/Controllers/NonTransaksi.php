<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NonTransaksi extends Controller
{
    public function indexUser()
    {
        $users = DB::select('SELECT * FROM view_user');
        return view('non_transaksi.users.index', ['users' => $users]);
    }
    
    public function createUser()
    {
        $roles = DB::select('SELECT * FROM role');
        return view('non_transaksi.users.create', ['roles'=> $roles]);
    }

    public function storeUser(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $idrole = $request->input('idrole');
    
        DB::statement('CALL create_user(?, ?, ?)', [$username, $password, $idrole]);
    
        return redirect()->route('user.index');
    }

    public function editUser($id)
    {
        $user = DB::selectOne('SELECT * FROM user WHERE iduser = ?', [$id]);
        $roles = DB::select('SELECT * FROM role');
        return view('non_transaksi.users.edit', ['roles'=> $roles, 'user'=> $user]);
    }
    
    public function updateUser(Request $request, $id)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $idrole = $request->input('idrole');
    
        DB::statement('CALL update_user(?, ?, ?, ?)', [$id, $username, $password, $idrole]);
    
        return redirect()->route('user.index');
    }

    public function deleteUser($id)
    {
        DB::statement('CALL delete_user(?)', [$id]);

        return redirect()->route('user.index');
    }

    
    public function indexRole()
    {
        $roles = DB::select('SELECT * FROM view_role');
        return view('non_transaksi.roles.index', ['roles' => $roles]);
    }
    
    public function createRole()
    {
        return view('non_transaksi.roles.create');
    }

    public function storeRole(Request $request)
    {
        DB::statement('CALL create_role(?)', [
            $request->nama_role
        ]);

        return redirect()->route('role.index');
    }

    public function editRole($id)
    {
        $role = DB::selectOne('SELECT * FROM role WHERE idrole = ?', [$id]);
        return view('non_transaksi.roles.edit', ['role'=> $role]);
    }

    public function updateRole(Request $request, $id)
    {
        DB::statement('CALL update_role(?, ?)', [
            $id,
            $request->nama_role
        ]);

        return redirect()->route('role.index');
    }

    public function deleteRole($id)
    {
        DB::statement('CALL delete_role(?)', [$id]);

        return redirect()->route('role.index');
    }
    
    public function indexVendor()
    {
        $vendors = DB::select('SELECT * FROM view_vendor');
        return view('non_transaksi.vendors.index', ['vendors' => $vendors]);
    }
    
    public function createVendor()
    {
        return view('non_transaksi.vendors.create');
    }

    public function storeVendor(Request $request)
    {
        DB::statement('CALL create_vendor(?, ?, ?)', [
            $request->nama_vendor,
            $request->badan_hukum,
            $request->status
        ]);

        return redirect()->route('vendor.index');
    }

    public function editVendor($id)
    {
        $vendor = DB::selectOne('SELECT * FROM vendor WHERE idvendor = ?', [$id]);
        return view('non_transaksi.vendors.edit', ['vendor'=> $vendor]);
    }

    public function updateVendor(Request $request, $id)
    {
        DB::statement('CALL update_vendor(?, ?, ?, ?)', [
            $id,
            $request->nama_vendor,
            $request->badan_hukum,
            $request->status
        ]);

        return redirect()->route('vendor.index');
    }

    public function deleteVendor($id)
    {
        DB::statement('CALL delete_vendor(?)', [$id]);

        return redirect()->route('vendor.index');
    }
    
    public function indexBarang()
    {
        $barangs = DB::select('SELECT * FROM view_barang');

        return view('non_transaksi.barangs.index', ['barangs' => $barangs]);
    }
    
    public function createBarang()
    {
        $satuans = DB::select('SELECT * FROM view_satuan');
        return view('non_transaksi.barangs.create', ['satuans' => $satuans]);
    }

    public function storeBarang(Request $request)
    {
        DB::statement('CALL create_barang(?, ?, ?, ?, ?)', [
            $request->nama,
            $request->jenis,
            $request->idsatuan,
            $request->status,
            $request->harga
        ]);
        $satuans = DB::select('SELECT * FROM view_satuan');
        return redirect()->route('barang.index');
    }

    public function editBarang($id)
    {
        $barang = DB::selectOne('SELECT * FROM barang WHERE idbarang = ?', [$id]);
        $satuans = DB::select('SELECT * FROM view_satuan');
        return view('non_transaksi.barangs.edit', ['barang'=> $barang]);
    }

    public function updateBarang(Request $request, $id)
    {
        DB::statement('CALL update_barang(?, ?, ?, ?, ?, ?)', [
            $id,
            $request->nama,
            $request->jenis,
            $request->idsatuan,
            $request->status,
            $request->harga
        ]);

        return redirect()->route('barang.index');
    }

    public function deleteBarang($id)
    {
        DB::statement('CALL delete_barang(?)', [$id]);

        return redirect()->route('barang.index');
    }
    
    public function indexSatuan()
    {
        $satuans = DB::select('SELECT * FROM view_satuan');
        return view('non_transaksi.satuans.index', ['satuans' => $satuans]);
    }
    
    public function createSatuan()
    {
        return view('non_transaksi.satuans.create');
    }

    public function storeSatuan(Request $request)
    {
        DB::statement('CALL create_Satuan(?, ?)', [
            $request->nama_satuan,
            $request->status
        ]);

        return redirect()->route('satuan.index');
    }

    public function editSatuan($id)
    {
        $satuan = DB::selectOne('SELECT * FROM satuan WHERE idsatuan = ?', [$id]);
        return view('non_transaksi.satuans.edit', ['satuan'=> $satuan]);
    }

    public function updateSatuan(Request $request, $id)
    {
        DB::statement('CALL update_Satuan(?, ?, ?)', [
            $id,
            $request->nama_satuan,
            $request->status
        ]);

        return redirect()->route('satuan.index');
    }

    public function deleteSatuan($id)
    {
        DB::statement('CALL delete_satuan(?)', [$id]);

        return redirect()->route('satuan.index');
    }

    
}   