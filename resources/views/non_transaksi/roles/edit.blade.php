@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Edit Role</h4>
    
    <div class="card">
        <h5 class="card-header">Edit Role</h5>
        
        <div class="card-body">
            <form action="{{ route('role.update', $role->idrole) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_role" class="form-label">Role Name</label>
                    <input type="text" class="form-control" id="nama_role" name="nama_role" value="{{ $role->nama_role }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Role</button>
            </form>
        </div>
    </div>
</div>
@endsection
