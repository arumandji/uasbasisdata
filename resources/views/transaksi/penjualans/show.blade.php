@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penjualan #{{ $penjualan->idpenjualan }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Penjualan</h5>
            <dl class="row">
                <dt class="col-sm-3">Tanggal</dt>
                <dd class="col-sm-9">{{ \Carbon\Carbon::parse($penjualan->created_at)->format('d/m/Y H:i:s') }}</dd>

                <dt class="col-sm-3">User</dt>
                <dd class="col-sm-9">{{ $penjualan->username }}</dd>

                <dt class="col-sm-3">Subtotal</dt>
                <dd class="col-sm-9">Rp {{ number_format($penjualan->subtotal_nilai, 2, ',', '.') }}</dd>

                <dt class="col-sm-3">Margin</dt>
                <dd class="col-sm-9">Rp {{ number_format($penjualan->margin, 2, ',', '.') }} ({{ $penjualan->persen }}%)</dd>

                <dt class="col-sm-3">PPN</dt>
                <dd class="col-sm-9">Rp {{ number_format($penjualan->ppn, 2, ',', '.') }}</dd>

                <dt class="col-sm-3">Total</dt>
                <dd class="col-sm-9">Rp {{ number_format($penjualan->total_nilai, 2, ',', '.') }}</dd>
            </dl>
        </div>
    </div>

    <h2 class="mb-3">Detail Item</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $detail)
                    <tr>
                        <td>{{ $detail->nama }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

