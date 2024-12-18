@extends('layouts.app')

@section('title', 'Retur')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Retur/</span> Daftar Retur</h4>

    <div class="card">
        <h5 class="card-header">Daftar Retur / 
            <a href="{{ route('retur.select-penerimaan') }}" class="btn btn-link text-primary p-0 m-0">Tambah Retur Baru</a>
        </h5>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Created At</th>
                        <th>User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($retur as $r)
                    <tr>
                        <td>{{ $r->idretur }}</td>
                        <td>{{ $r->created_at }}</td>
                        <td>{{ $r->username }}</td>
                        <td>
                            <a href="{{ route('retur.show', $r->idretur) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data retur</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
