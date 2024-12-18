@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Edit Penjualan</h4>
    <div class="card">
        <h5 class="card-header">Form Edit Penjualan</h5>
        <div class="card-body">
            <form action="{{ route('penjualan.update', $penjualan->idpenjualan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="datetime-local" id="tanggal" name="tanggal" value="{{ $penjualan->tanggal }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="subtotal_nilai" class="form-label">Subtotal Nilai</label>
                    <input type="number" id="subtotal_nilai" name="subtotal_nilai" step="0.01" value="{{ $penjualan->subtotal_nilai }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="ppn" class="form-label">PPN</label>
                    <input type="number" id="ppn" name="ppn" step="0.01" value="{{ $penjualan->ppn }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="total_nilai" class="form-label">Total Nilai</label>
                    <input type="number" id="total_nilai" name="total_nilai" step="0.01" value="{{ $penjualan->total_nilai }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="Pending" {{ $penjualan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Selesai" {{ $penjualan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="iduser" class="form-label">ID User</label>
                    <input type="number" id="iduser" name="iduser" value="{{ $penjualan->iduser }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="idmargin_penjualan" class="form-label">ID Margin Penjualan</label>
                    <input type="number" id="idmargin_penjualan" name="idmargin_penjualan" value="{{ $penjualan->idmargin_penjualan }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
