@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Hapus Penjualan</h4>
    <div class="card">
        <h5 class="card-header">Konfirmasi Hapus Penjualan</h5>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus penjualan dengan ID <strong>{{ $penjualan->idpenjualan }}</strong>?</p>
            <form action="{{ route('penjualan.destroy', $penjualan->idpenjualan) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
                <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

