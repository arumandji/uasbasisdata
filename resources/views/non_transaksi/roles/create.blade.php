@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Create Role</h4>
    
    <div class="card">
        <h5 class="card-header">Create Role</h5>
        
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_role" class="form-label">Role Name</label>
                    <input type="text" class="form-control" id="nama_role" name="nama_role" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Create Role</button>
            </form>
        </div>
    </div>
</div>
@endsection
