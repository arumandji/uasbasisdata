@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Barang</h4>

    <div class="card">
        <h5 class="card-header">Barang / <a href="{{ route('barang.create') }}" class="btn btn-link text-primary p-0 m-0">Tambah Barang</a></h5>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Satuan</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($barangs as $barang)
                            <tr>
                                <td>{{ $barang->idbarang }}</td>
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $barang->jenis }}</td>
                                <td>{{ $barang->idsatuan }}</td>
                                <td>{{ $barang->harga }}</td>
                                <td>{{ $barang->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('barang.edit', $barang->idbarang) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('barang.delete', $barang->idbarang) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
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
