@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Edit Barang</h4>
    
    <div class="card">
        <h5 class="card-header">Form Edit Barang</h5>
        <div class="card-body">
            <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Barang</label>
                    <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $barang->jenis }}" required>
                </div>
                {{-- <div class="mb-3">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $barang->stock }}" required>
                </div> --}}
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="idsatuan" class="form-label">Unit</label>
                        <select class="form-select" id="idsatuan" name="idsatuan" required>
                            {{-- @foreach($barang as $satuan)
                                <option value="{{ $satuan->idsatuan }}">{{ $satuan->nama_satuan }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="{{ $barang->harga }}" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1" {{ $barang->status == '1' ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ $barang->status == '0' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
