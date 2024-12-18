@extends('layouts.app')

@section('title', 'Edit Satuan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Edit Satuan</h4>

    <div class="card">
        <h5 class="card-header">Satuan / <span class="text-primary">Edit Satuan</span></h5>

        <div class="card-body">
            <form action="{{ route('satuan.update', $satuan->idsatuan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_satuan" class="form-label">Nama Satuan</label>
                    <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" value="{{ $satuan->nama_satuan }}" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1" {{ $satuan->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $satuan->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui Satuan</button>
            </form>
        </div>
    </div>
</div>
@endsection
