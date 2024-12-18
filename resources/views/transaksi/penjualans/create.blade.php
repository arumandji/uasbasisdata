<!-- resources/views/penjualan/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Penjualan Baru</h1>

    <!-- Form untuk memasukkan data penjualan -->
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="penjualan_id" class="form-label">ID Penjualan</label>
            <input type="number" class="form-control" id="penjualan_id" name="penjualan_id" required>
        </div>

        <div class="mb-3">
            <label for="total_subtotal" class="form-label">Total Subtotal</label>
            <input type="number" class="form-control" id="total_subtotal" name="total_subtotal" step="0.01" value="0.00" required>
        </div>

        <div class="mb-3">
            <label for="total_margin" class="form-label">Total Margin</label>
            <input type="number" class="form-control" id="total_margin" name="total_margin" step="0.01" value="0.00" required>
        </div>

        <div class="mb-3">
            <label for="total_ppn" class="form-label">Total PPN</label>
            <input type="number" class="form-control" id="total_ppn" name="total_ppn" step="0.01" value="0.00" required>
        </div>

        <div class="mb-3">
            <label for="total_nilai" class="form-label">Total Nilai</label>
            <input type="number" class="form-control" id="total_nilai" name="total_nilai" step="0.01" value="0.00" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
    </form>
</div>
@endsection
