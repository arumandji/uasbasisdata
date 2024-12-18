@extends('layouts.app')

@section('title', 'Create Penerimaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Penerimaan/</span> Create</h4>

    <div class="card">
        <h5 class="card-header">Create New Penerimaan</h5>

        <div class="card-body">
            <form action="{{ route('penerimaan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idpengadaan" value="{{ $pengadaan->idpengadaan }}">

                <div class="mb-3">
                    <label for="barang_id" class="form-label">Barang</label>
                    <select class="form-select" id="barang_id" name="barang_id" required>
                        @foreach($barang as $b)
                            <option value="{{ $b->idbarang }}" data-max="{{ $b->jumlah_max }}">{{ $b->nama }} (Max: {{ $b->jumlah_max }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah_terima" class="form-label">Jumlah Terima</label>
                    <input type="number" class="form-control" id="jumlah_terima" name="jumlah_terima" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Create Penerimaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('barang_id').addEventListener('change', function() {
        const maxJumlah = this.options[this.selectedIndex].getAttribute('data-max');
        document.getElementById('jumlah_terima').max = maxJumlah;
    });
</script>
@endsection
