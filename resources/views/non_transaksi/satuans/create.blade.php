@extends('layouts.app')

@section('title', 'Tambah Satuan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Tambah Satuan</h4>

    <div class="card">
        <h5 class="card-header">Tambah Satuan</h5>

        <div class="card-body">
            <form action="{{ route('satuan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_satuan" class="form-label">Nama Satuan</label>
                    <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Satuan</button>
            </form>
        </div>
    </div>
</div>
@endsection
