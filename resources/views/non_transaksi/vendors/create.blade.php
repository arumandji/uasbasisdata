@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Create Vendor</h4>
    
    <div class="card">
        <h5 class="card-header">Create Vendor</h5>
        
        <div class="card-body">
            <form action="{{ route('vendor.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_vendor" class="form-label">Vendor Name</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required>
                </div>
                
                <div class="mb-3">
                    <label for="badan_hukum" class="form-label">Legal Entity</label>
                    <select class="form-select" id="badan_hukum" name="badan_hukum" required>
                        <option value="P">Perseroan Terbatas (PT)</option>
                        <option value="C">Commanditaire Vennootschap (CV)</option>
                        <option value="F">Firma</option>
                        <option value="K">Koperasi</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Create Vendor</button>
            </form>
        </div>
    </div>
</div>
@endsection
