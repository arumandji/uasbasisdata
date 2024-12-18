@extends('layouts.app')

@section('title', 'Create Retur')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Retur /</span> Create Retur
    </h4>

    <div class="card">
        <h5 class="card-header">Form Retur</h5>
        <div class="card-body">
            <form action="{{ route('retur.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idpenerimaan" value="{{ $penerimaan->idpenerimaan }}">

                <!-- Barang -->
                <div class="mb-3">
                    <label for="barang_id" class="form-label fw-semibold">Barang</label>
                    <select class="form-select" id="barang_id" name="barang_id" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->idbarang }}" data-max="{{ $b->jumlah_terima }}">
                                {{ $b->nama }} (Max: {{ $b->jumlah_terima }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah Retur -->
                <div class="mb-3">
                    <label for="jumlah_retur" class="form-label fw-semibold">Jumlah Retur</label>
                    <input type="number" class="form-control" id="jumlah_retur" name="jumlah_retur" 
                           min="1" required placeholder="Masukkan jumlah retur">
                </div>

                <!-- Alasan -->
                <div class="mb-3">
                    <label for="alasan" class="form-label fw-semibold">Alasan Retur</label>
                    <textarea class="form-control" id="alasan" name="alasan" rows="3" 
                              placeholder="Masukkan alasan retur" required></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Create Retur</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Menyesuaikan jumlah maksimum input sesuai pilihan barang
    document.getElementById('barang_id').addEventListener('change', function() {
        const maxJumlah = this.options[this.selectedIndex].getAttribute('data-max');
        const inputJumlah = document.getElementById('jumlah_retur');
        inputJumlah.max = maxJumlah;
        inputJumlah.value = ""; // Reset value saat barang berganti
    });
</script>
@endpush
@endsection
