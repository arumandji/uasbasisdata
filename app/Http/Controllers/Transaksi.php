<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Transaksi extends Controller
{
    public function indexKartuStock()
    {
        // Ambil data kartu stok, dikelompokkan berdasarkan idbarang
        $kartuStok = DB::table('kartu_stok')
            ->join('barang', 'kartu_stok.idbarang', '=', 'barang.idbarang')
            ->select('kartu_stok.*', 'barang.nama as nama_barang')
            ->orderBy('kartu_stok.idbarang', 'desc')
            ->get()
            ->groupBy('idbarang'); // Mengelompokkan data berdasarkan idbarang

        // Ambil semua barang dan stok
        // $barangList = DB::table('barang')
        //     ->select('idbarang', 'nama', 'stock')
        //     ->orderBy('nama')
        //     ->get();

        return view('transaksi.kartu_stoks.index', compact('kartuStok'));
    }
    public function indexPengadaan()
    {
        // $pengadaan = DB::select('SELECT * FROM pengadaan');
        // $pengadaan = DB::table('pengadaan')
        //     ->join('vendor', 'vendor.idvendor', '=', 'pengadaan.vendor_idvendor')
        //     // ->join('user', 'user.iduser', '=', 'pengadaan.iduser')
        //     ->select('pengadaan.*', 'vendor.nama_vendor')
        //     ->orderBy('pengadaan.timestamp', 'desc')
        //     ->get();
        $pengadaan = DB::select('SELECT * FROM view_pengadaan');

        return view('transaksi.pengadaans.index', compact('pengadaan'));
    }

    public function createPengadaan()
    {
        $vendor = DB::select('SELECT * FROM vendor');
        $barang = DB::select('SELECT * FROM barang WHERE status = ?', [1]);
        return view('transaksi.pengadaans.create', compact('vendor', 'barang'));
    }

    public function storePengadaan(Request $request)
    {
        $items = collect($request->items)->map(function ($item) {
            return [
                'barang_id' => $item['barang_id'] ?? 0,
                'jumlah' => $item['jumlah'] ?? 0,
            ];
        })->toJson();

        DB::select('CALL CreatePengadaan(?, ?, ?)', [
            $request->vendor_id,
            1,
            $items
        ]);

        return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil dibuat');
    }

    public function showPengadaan($id)
    {
        $pengadaan = DB::table('view_pengadaan')
            ->where('idpengadaan', $id)
            ->first();

        $details = DB::table('view_detailpengadaan')
            ->where('idpengadaan', $id)
            ->get();

        return view('transaksi.pengadaans.show', compact('pengadaan', 'details'));
    }
    // Method untuk menampilkan daftar penerimaan
    public function indexPenerimaan()
    {
        $penerimaan = DB::table('penerimaan')
            ->join('user', 'penerimaan.iduser', '=', 'user.iduser')
            ->select('penerimaan.*', 'user.username')
            ->orderBy('penerimaan.created_at', 'desc')
            ->get();

        return view('transaksi.penerimaans.index', compact('penerimaan'));
    }

    public function getBarangByPengadaan(Request $request)
    {
        
        Log::info('ID Pengadaan:', ['idpengadaan' => $request->idpengadaan]);
        $idpengadaan = $request->idpengadaan;

        // Ambil barang dari detail_pengadaan berdasarkan idpengadaan
        $barang = DB::table('detail_pengadaan')
            ->join('barang', 'detail_pengadaan.idbarang', '=', 'barang.idbarang')
            ->where('detail_pengadaan.idpengadaan', $idpengadaan)
            ->select('barang.idbarang', 'barang.nama', 'detail_pengadaan.jumlah as jumlah_max')
            ->get();

        return response()->json($barang);
    }

    public function selectPengadaan()
    {
        $pengadaan = DB::table('pengadaan')
            ->where('status', '!=', '1') // Hanya pengadaan yang belum selesai
            ->get();
            // return $pengadaan;
        return view('transaksi.penerimaans.select_pengadaan', compact('pengadaan'));
    }
    // Menampilkan detail penerimaan
    public function showPenerimaan($id)
    {
        // Ambil data penerimaan berdasarkan id
        $penerimaan = DB::table('penerimaan')
            ->join('user', 'penerimaan.iduser', '=', 'user.iduser')
            ->select('penerimaan.*', 'user.username')
            ->where('penerimaan.idpenerimaan', $id)
            ->first();

        if (!$penerimaan) {
            return redirect()->route('penerimaan.index')->withErrors(['error' => 'Penerimaan tidak ditemukan']);
        }

        // Ambil detail penerimaan terkait
        $detailPenerimaan = DB::table('detail_penerimaan')
            ->join('barang', 'detail_penerimaan.idbarang', '=', 'barang.idbarang')
            ->select('detail_penerimaan.*', 'barang.nama as nama_barang')
            ->where('detail_penerimaan.idpenerimaan', $id)
            ->get();

        return view('transaksi.penerimaans.show', compact('penerimaan', 'detailPenerimaan'));
    }

    // Menampilkan form penerimaan
    public function createPenerimaan(Request $request)
    {
        $idpengadaan = $request->query('idpengadaan'); // Ambil ID Pengadaan dari parameter
        $pengadaan = DB::table('pengadaan')->where('idpengadaan', $idpengadaan)->first();
        // Ambil barang berdasarkan ID Pengadaan
        $barang = DB::table('detail_pengadaan')
            ->join('barang', 'detail_pengadaan.idbarang', '=', 'barang.idbarang')
            ->where('detail_pengadaan.idpengadaan', $idpengadaan)
            ->select('barang.idbarang', 'barang.nama', 'detail_pengadaan.jumlah as jumlah_max')
            ->get();

        if (!$pengadaan) {
            return redirect()->route('penerimaan.select-pengadaan')->with('error', 'ID Pengadaan tidak ditemukan.');
        }

        return view('transaksi.penerimaans.create', compact('pengadaan', 'barang'));
    }
    public function storePenerimaan(Request $request)
    {
        $validated = $request->validate([
            'idpengadaan' => 'required|integer|exists:pengadaan,idpengadaan',
            'barang_id' => 'required|integer|exists:barang,idbarang',
            'jumlah_terima' => 'required|integer|min:1',
        ]);
    
        DB::statement('CALL CreatePenerimaan(?, ?, ?, ?)', [
            $validated['barang_id'],
            '1',
            $validated['jumlah_terima'],
            $validated['idpengadaan'],
        ]);
    
        return redirect()->route('penerimaan.index')->with('success', 'Penerimaan berhasil dibuat.');
    }
    // Menampilkan daftar retur
    public function indexRetur()
{
    $retur = DB::table('retur')
        ->join('user', 'retur.iduser', '=', 'user.iduser')
        ->select('retur.*', 'user.username')
        ->orderBy('retur.created_at', 'desc')
        ->get();

    return view('transaksi.returs.index', compact('retur'));
}

public function showRetur($id)
    {
        // Misalnya, ambil data retur berdasarkan ID
        $retur = DB::table('retur')
            ->join('detail_retur', 'retur.idretur', '=', 'detail_retur.idretur')
            ->where('retur.idretur', $id)
            ->select('retur.*', 'detail_retur.*')
            ->first();

        // Jika retur tidak ditemukan, beri respons error
        if (!$retur) {
            abort(404, 'Data retur tidak ditemukan.');
        }

        // Return view atau JSON
        return view('transaksi.returs.show', compact('retur'));
    }

public function selectPenerimaan()
{
    $penerimaan = DB::table('penerimaan')->get();
    // return $penerimaan;

    return view('transaksi.returs.select_penerimaan', compact('penerimaan'));
}

public function createRetur(Request $request)
{
    $idpenerimaan = $request->query('idpenerimaan');
    $penerimaan = DB::table('penerimaan')->where('idpenerimaan', $idpenerimaan)->first();
    $barang = DB::table('detail_penerimaan')
        ->join('barang', 'detail_penerimaan.idbarang', '=', 'barang.idbarang')
        ->select('barang.idbarang', 'barang.nama', 'detail_penerimaan.jumlah_terima')
        ->where('detail_penerimaan.idpenerimaan', $idpenerimaan)
        ->get();

    return view('transaksi.returs.create', compact('penerimaan', 'barang'));
}

public function storeRetur(Request $request)
{
    $validated = $request->validate([
        'idpenerimaan' => 'required|integer|exists:penerimaan,idpenerimaan',
        'barang_id' => 'required|integer|exists:barang,idbarang',
        'jumlah_retur' => 'required|integer|min:1',
        'alasan' => 'required|string|max:255',
    ]);

    DB::statement('CALL CreateRetur(?, ?, ?, ?, ?)', [
        $validated['idpenerimaan'],
        $validated['barang_id'],
        '1',
        $validated['jumlah_retur'],
        $validated['alasan'],
    ]);

    return redirect()->route('retur.index')->with('success', 'Retur berhasil dibuat.');
}

    // Menyimpan data penerimaan



    public function indexPenjualan()
    {
        // $penjualan = DB::table('penjualan')
        // ->join('margin_penjualan', 'penjualan.idmargin_penjualan', '=', 'margin_penjualan.idmargin_penjualan')
        // ->select('penjualan.*', 'margin_penjualan.persen')
        // ->get();
        // $penjualan = DB::select('SELECT * FROM view_penjualan');
        $penjualan = DB::select('SELECT * FROM view_penjualan');

        return view('transaksi.penjualans.index', compact('penjualan'));
    }
    public function createPenjualan()
    {
        $barang = DB::table('barang')->where('status', 1)->get(); // Ambil barang yang aktif
        return view('transaksi.penjualans.create', compact('barang'));
    }

    public function storePenjualan(Request $request)
    {
        $items = collect($request->items)->map(function ($item) {
            return [
                'barang_id' => $item['barang_id'] ?? 0,
                'jumlah' => $item['jumlah'] ?? 0,
            ];
        })->toJson();
    
        DB::select('CALL CreatePenjualan(?, ?)', [
            1,
            $items
        ]);
    
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dibuat');
    }
    public function showPenjualan($id)
    {
        $penjualan = DB::table('penjualan')
            ->join('user', 'penjualan.iduser', '=', 'user.iduser')
            ->join('margin_penjualan', 'penjualan.idmargin_penjualan', '=', 'margin_penjualan.idmargin_penjualan')
            ->select(
                'penjualan.*',
                'user.username',
                DB::raw('(penjualan.subtotal_nilai * (margin_penjualan.persen / 100)) as margin'),
                'penjualan.subtotal_nilai',
                'penjualan.ppn',
                'penjualan.total_nilai'
            )
            ->where('penjualan.idpenjualan', $id)
            ->first();

        $details = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.idbarang', '=', 'barang.idbarang')
            ->select(
                'barang.nama',
                'detail_penjualan.harga_satuan',
                'detail_penjualan.jumlah',
                'detail_penjualan.subtotal'
            )
            ->where('detail_penjualan.penjualan_idpenjualan', $id)
            ->get();

        return view('transaksi.penjualans.show', compact('penjualan', 'details'));
    }


}