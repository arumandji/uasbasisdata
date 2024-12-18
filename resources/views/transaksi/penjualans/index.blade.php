@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi</span> Penjualan</h4>

    <div class="card">
        <h5 class="card-header">Penjualan / <a href="{{ route('penjualan.create') }}" class="btn btn-link text-primary p-0 m-0">Tambah Penjualan</a></h5>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>ID User</th>
                            <th>Subtotal</th>
                            <th>PPN</th>
                            <th>Total</th>
                            <th>Margin (%)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan as $p)
                            <tr>
                                <td>{{ $p->idpenjualan }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $p->user_iduser }}</td>
                                <td>Rp {{ number_format($p->subtotal_nilai, 2, ',', '.') }}</td>
                                <td>Rp {{ number_format($p->ppn, 2, ',', '.') }}</td>
                                <td>Rp {{ number_format($p->total_nilai, 2, ',', '.') }}</td>
                                <td>{{ $p->persen }}%</td>
                                <td>
                                    <a href="{{ route('penjualan.show', $p->idpenjualan) }}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
