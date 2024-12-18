@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Vendors</h4>
    
    <div class="card">
        <h5 class="card-header">Vendors / <a href="{{ route('vendor.create') }}" class="btn btn-link text-primary p-0 m-0">Create New Vendor</a></h5>
        
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Vendor Name</th>
                        <th>Legal Entity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->idvendor }}</td>
                        <td>{{ $vendor->nama_vendor }}</td>
                        <td>{{ $vendor->badan_hukum }}</td>
                        <td>{{ $vendor->status }}</td>
                        <td>
                            <a href="{{ route('vendor.edit', $vendor->idvendor) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('vendor.delete', $vendor->idvendor) }}" method="POST" style="display: inline-block;">
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
