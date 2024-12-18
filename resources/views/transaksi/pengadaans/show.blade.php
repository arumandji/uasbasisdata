@extends('layouts.app')

@section('title', 'Pengadaan Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengadaan/</span> Details</h4>

    <div class="card mb-4">
        <h5 class="card-header">Pengadaan #{{ $pengadaan->idpengadaan }}</h5>
        <div class="card-body">
            <p class="mb-2">
                <strong>Timestamp:</strong> {{ $pengadaan->timestamp }}
            </p>
            <p class="mb-2">
                <strong>Vendor:</strong> {{ $pengadaan->nama_vendor }}
            </p>
            <p class="mb-2">
                <strong>Subtotal:</strong> {{ number_format($pengadaan->subtotal_nilai, 2) }}
            </p>
            <p class="mb-2">
                <strong>PPN:</strong> {{ number_format($pengadaan->ppn, 2) }}
            </p>
            <p class="mb-2">
                <strong>Total:</strong> {{ number_format($pengadaan->total_nilai, 2) }}
            </p>
            <p class="mb-0">
                <strong>Status:</strong> {{ $pengadaan->status == 0 ? 'Pending' : 'Completed' }}
            </p>
        </div>
    </div>

    <h5 class="mb-4">Items</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped table-hover">
            <thead class="table-light">
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
                        <td>{{ number_format($detail->harga_satuan, 2) }}</td>
                        <td>{{ number_format($detail->sub_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
