@extends('layouts.app')

@section('title', 'Select Pengadaan for Penerimaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Penerimaan/</span> Select Pengadaan</h4>

    <div class="card">
        <h5 class="card-header">Select Pengadaan for Penerimaan</h5>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Timestamp</th>
                        <th>Vendor</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengadaan as $p)
                        <tr>
                            <td>{{ $p->idpengadaan }}</td>
                            <td>{{ $p->timestamp }}</td>
                            <td>{{ $p->vendor_idvendor }}</td>
                            <td>{{ number_format($p->total_nilai, 2) }}</td>
                            <td>
                                <a href="{{ route('penerimaan.create', ['idpengadaan' => $p->idpengadaan]) }}" class="btn btn-sm btn-primary">Select</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
