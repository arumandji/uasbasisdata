@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Transaksi /</span> Penjualan
    </h4>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Detail Penjualan</h5>
        </div>
        <div class="card-body">
            <p><strong>Status:</strong> {{ $penjualan->status }}</p>
            <p><strong>Total Nilai:</strong> {{ number_format($penjualan->total_nilai, 0, ',', '.') }}</p>

            <h6 class="mt-4">Detail Barang</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->nama }}</td>
                        <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
