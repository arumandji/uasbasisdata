@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Roles</h4>
    
    <div class="card">
        <h5 class="card-header">Roles / <a href="{{ route('role.create') }}" class="btn btn-link text-primary p-0 m-0">Create New Role</a></h5>
        
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->idrole }}</td>
                        <td>{{ $role->nama_role }}</td>
                        <td>
                            <a href="{{ route('role.edit', $role->idrole) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('role.delete', $role->idrole) }}" method="POST" class="d-inline">
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
@endsection
