@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Satuan</h4>

    <div class="card">
        <h5 class="card-header">Satuan / <a href="{{ route('satuan.create') }}" class="btn btn-link text-primary p-0 m-0">Tambah Satuan</a></h5>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Satuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($satuans as $satuan)
                            <tr>
                                <td>{{ $satuan->idsatuan }}</td>
                                <td>{{ $satuan->nama_satuan }}</td>
                                <td>{{ $satuan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <a href="{{ route('satuan.edit', $satuan->idsatuan) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('satuan.delete', $satuan->idsatuan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
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
