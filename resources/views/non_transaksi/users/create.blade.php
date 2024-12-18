@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Create User</h4>
    
    <div class="card">
        <h5 class="card-header">Create User</h5>
        
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <div class="mb-3">
                    <label for="idrole" class="form-label">Role</label>
                    <select class="form-select" id="idrole" name="idrole" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Create User</button>
            </form>
        </div>
    </div>
</div>
@endsection
