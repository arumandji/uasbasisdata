@extends('layouts.app')

@section('title', 'Pilih Penerimaan untuk Retur')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Retur/</span> Pilih Penerimaan</h4>

    <div class="card">
        <h5 class="card-header">Pilih Penerimaan Untuk Retur</h5>

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
                    @forelse($penerimaan as $p)
                    <tr>
                        <td>{{ $p->idpenerimaan }}</td>
                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->iduser }}</td>
                        <td>
                            <a href="{{ route('retur.create', ['idpenerimaan' => $p->idpenerimaan]) }}" class="btn btn-sm btn-primary">Pilih</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data penerimaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
