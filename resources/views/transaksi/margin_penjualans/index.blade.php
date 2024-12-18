@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Transaksi /</span> Margin Penjualan
    </h4>
    <div class="card">
        <h5 class="card-header">Daftar Margin Penjualan / <a href="{{ route('margin.create') }}" class="btn btn-link text-primary p-0 m-0">Tambah Margin</a></h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>ID Margin</th>
                        <th>Persen</th>
                        <th>Status</th>
                        <th>ID User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($margin as $margin)
                    <tr>
                        <td>{{ $margin->idmargin_penjualan }}</td>
                        <td>{{ number_format($margin->persen, 2) }}%</td>
                        <td>{{ $margin->status == 1 ? 'Aktif' : 'Nonaktif' }}</td>
                        <td>{{ $margin->iduser }}</td>
                        <td>
                            <a href="{{ route('margin.edit', $margin->idmargin_penjualan) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('margin.delete', $margin->idmargin_penjualan) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
