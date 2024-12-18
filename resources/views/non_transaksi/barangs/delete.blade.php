@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <h1>Edit Barang</h1>
    <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Type</label>
            <select class="form-select" id="jenis" name="jenis" required>
                <option value="B" {{ $barang->jenis == 'B' ? 'selected' : '' }}>Barang</option>
                <option value="J" {{ $barang->jenis == 'J' ? 'selected' : '' }}>Jasa</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="idsatuan" class="form-label">Unit</label>
            <select class="form-select" id="idsatuan" name="idsatuan" required>
                @foreach($satuans as $satuan)
                    <option value="{{ $satuan->idsatuan }}" {{ $barang->idsatuan == $satuan->idsatuan ? 'selected' : '' }}>
                        {{ $satuan->nama_satuan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Price</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $barang->harga }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="1" {{ $barang->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $barang->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Barang</button>
    </form>
@endsection
