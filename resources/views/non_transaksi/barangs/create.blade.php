@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Create Barang</h4>

    <div class="card">
        <h5 class="card-header">Tambah Barang</h5>

        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="jenis" class="form-label">Type</label>
                    <select class="form-select" id="jenis" name="jenis" required>
                        <option value="B">Barang</option>
                        <option value="J">Jasa</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="idsatuan" class="form-label">Unit</label>
                    <select class="form-select" id="idsatuan" name="idsatuan" required>
                        @foreach($satuans as $satuan)
                            <option value="{{ $satuan->idsatuan }}">{{ $satuan->nama_satuan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Price</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Barang</button>
            </form>
        </div>
    </div>
</div>
@endsection
