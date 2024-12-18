@extends('layouts.app')

@section('title', 'Retur Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Retur/</span> Details</h4>

    <div class="card mb-4">
        <h5 class="card-header">Retur #{{ $retur->idretur }}</h5>
        <div class="card-body">
            <p class="mb-2">
                <strong>Timestamp:</strong> {{ $retur->created_at }}
            </p>
            <p class="mb-2">
                <strong>User:</strong> {{ $retur->iduser }}
            </p>
            {{-- <p class="mb-2">
                <strong>Barang:</strong> {{ $retur->idbarang }}
            </p> --}}
            <p class="mb-2">
                <strong>Jumlah Retur:</strong> {{ $retur->jumlah }}
            </p>
            <p class="mb-0">
                <strong>Alasan:</strong> {{ $retur->alasan }}
            </p>
        </div>
    </div>
</div>
@endsection
