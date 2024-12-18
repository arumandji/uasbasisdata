@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non Transaksi/</span> Edit Vendor</h4>
    
    <div class="card">
        <h5 class="card-header">Edit Vendor</h5>
        
        <div class="card-body">
            <form action="{{ route('vendor.update', $vendor->idvendor) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_vendor" class="form-label">Vendor Name</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="{{ $vendor->nama_vendor }}" required>
                </div>

                <div class="mb-3">
                    <label for="badan_hukum" class="form-label">Legal Entity</label>
                    <select class="form-select" id="badan_hukum" name="badan_hukum" required>
                        <option value="P" {{ $vendor->badan_hukum == 'P' ? 'selected' : '' }}>Perseroan Terbatas (PT)</option>
                        <option value="C" {{ $vendor->badan_hukum == 'C' ? 'selected' : '' }}>Commanditaire Vennootschap (CV)</option>
                        <option value="F" {{ $vendor->badan_hukum == 'F' ? 'selected' : '' }}>Firma</option>
                        <option value="K" {{ $vendor->badan_hukum == 'K' ? 'selected' : '' }}>Koperasi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1" {{ $vendor->status == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $vendor->status == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Vendor</button>
            </form>
        </div>
    </div>
</div>
@endsection
