@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Tambah Margin Penjualan</h4>
    <div class="card">
        <h5 class="card-header">Form Tambah Margin Penjualan</h5>
        <div class="card-body">
            <form action="{{ route('margin.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="persen" class="form-label">Persentase Margin (%)</label>
                    <input type="number" id="persen" name="persen" step="0.01" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="iduser" class="form-label">ID User</label>
                    <select id="iduser" name="iduser" class="form-select" required>
                        <option value=""></option>
                        @foreach(DB::table('users')->get() as $user)
                            <option value="{{ $user->iduser }}">{{ $user->iduser }} - {{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('margin.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
