@extends('layouts.app')

@section('title', 'Pengadaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Pengadaan</h4>

    <div class="card">
        <h5 class="card-header">Pengadaan / <a href="{{ route('pengadaan.create') }}" class="btn btn-link text-primary p-0 m-0">Create New Pengadaan</a></h5>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Timestamp</th>
                        <th>Vendor</th>
                        <th>Subtotal</th>
                        <th>PPN</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($pengadaan as $p)
                    <tr>
                        <td>{{ $p->idpengadaan }}</td>
                        <td>{{ $p->timestamp }}</td>
                        <td>{{ $p->nama_vendor }}</td>
                        <td>{{ number_format($p->subtotal_nilai, 2) }}</td>
                        <td>{{ number_format($p->ppn, 2) }}</td>
                        <td>{{ number_format($p->total_nilai, 2) }}</td>
                        <td>{{ $p->status == 0 ? 'Pending' : 'Completed' }}</td>
                        <td>
                            <a href="{{ route('pengadaan.show', $p->idpengadaan) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data pengadaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
