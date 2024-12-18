@extends('layouts.app')

@section('title', 'Penerimaan Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Penerimaan/</span> Details</h4>

    <div class="card mb-4">
        <h5 class="card-header">Penerimaan #{{ $penerimaan->idpenerimaan }}</h5>
        <div class="card-body">
            <p class="mb-2">
                <strong>Timestamp:</strong> {{ $penerimaan->created_at }}
            </p>
            <p class="mb-2">
                <strong>User:</strong> {{ $penerimaan->username }}
            </p>
            <p class="mb-2">
                <strong>Status:</strong> {{ $penerimaan->status == 0 ? 'Pending' : 'Completed' }}
            </p>
        </div>
    </div>

    <h5 class="mb-4">Items</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Barang</th>
                    <th>Jumlah Terima</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailPenerimaan as $detail)
                    <tr>
                        <td>{{ $detail->nama_barang }}</td>
                        <td>{{ $detail->jumlah_terima }}</td>
                        <td>{{ number_format($detail->harga_satuan, 2) }}</td>
                        <td>{{ number_format($detail->sub_total_terima, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
