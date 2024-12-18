@extends('layouts.app')

@section('title', 'Penerimaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Penerimaan/</span> List</h4>

    <div class="card">
        <h5 class="card-header">Penerimaan / <a href="{{ route('penerimaan.select-pengadaan') }}" class="btn btn-link text-primary p-0 m-0">Create New Penerimaan</a></h5>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Created At</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($penerimaan as $p)
                        <tr>
                            <td>{{ $p->idpenerimaan }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>{{ $p->username }}</td>
                            <td>{{ $p->status == 0 ? 'Pending' : 'Completed' }}</td>
                            <td>
                                <a href="{{ route('penerimaan.show', $p->idpenerimaan) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
