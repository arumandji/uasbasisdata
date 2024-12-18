@extends('layouts.app')

@section('title', 'Create Pengadaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengadaan/</span> Create</h4>

    <div class="card">
        <h5 class="card-header">Create New Pengadaan</h5>

        <div class="card-body">
            <form action="{{ route('pengadaan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="vendor_id" class="form-label">Vendor</label>
                    <select class="form-select" id="vendor_id" name="vendor_id" required>
                        @foreach($vendor as $v)
                            <option value="{{ $v->idvendor }}">{{ $v->nama_vendor }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="items">
                    <div class="item mb-3">
                        <h5>Item 1</h5>
                        <div class="row">
                            <div class="col">
                                <label for="items[0][barang_id]" class="form-label">Barang</label>
                                <select class="form-select" name="items[0][barang_id]" required>
                                    @foreach($barang as $b)
                                        <option value="{{ $b->idbarang }}">{{ $b->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="items[0][jumlah]" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="items[0][jumlah]" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="add-item">Add Item</button>
                    <button type="submit" class="btn btn-primary">Create Pengadaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let itemCount = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        const itemsDiv = document.getElementById('items');
        const newItem = document.createElement('div');
        newItem.className = 'item mb-3';
        newItem.innerHTML = `
            <h5>Item ${itemCount + 1} <button type="button" class="btn-close float-end remove-item" aria-label="Remove"></button></h5>
            <div class="row">
                <div class="col">
                    <label for="items[${itemCount}][barang_id]" class="form-label">Barang</label>
                    <select class="form-select" name="items[${itemCount}][barang_id]" required>
                        @foreach($barang as $b)
                            <option value="{{ $b->idbarang }}">{{ $b->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="items[${itemCount}][jumlah]" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="items[${itemCount}][jumlah]" required>
                </div>
            </div>
        `;
        itemsDiv.appendChild(newItem);
        itemCount++;

        // Add event listener to the remove button
        newItem.querySelector('.remove-item').addEventListener('click', function() {
            newItem.remove();
            itemCount--;
        });
    });
</script>
@endsection
