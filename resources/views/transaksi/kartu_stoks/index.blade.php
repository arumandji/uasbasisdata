@extends('layouts.app')

@section('title', 'Kartu Stok')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stok/</span> Kartu Stok</h4>

    @foreach($kartuStok as $idbarang => $stokItems)
        <div class="card mb-4">
            <h5 class="card-header">{{ $stokItems->first()->nama_barang }}</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Transaksi</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stokItems as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @switch($item->jenis_transaksi)
                                            @case('p')
                                                Penerimaan
                                                @break
                                            @case('r')
                                                Retur
                                                @break
                                            @case('s')
                                                Penjualan
                                                @break
                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                    <td>{{ $item->masuk ?: '-' }}</td>
                                    <td>{{ $item->keluar ?: '-' }}</td>
                                    <td>{{ $item->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
