@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Barang</h2>

    <div class="card" style="max-width: 600px;">
        <div class="row g-0">
            <div class="col-md-4">
                @if ($barang->foto)
                    <img src="{{ asset('foto_barang/' . $barang->foto) }}" class="img-fluid rounded-start" alt="Foto Barang">
                @else
                    <img src="https://via.placeholder.com/150" class="img-fluid rounded-start" alt="Tidak ada foto">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                    <p class="card-text"><strong>Kode:</strong> {{ $barang->kode }}</p>
                    <p class="card-text"><strong>Deskripsi:</strong> {{ $barang->deskripsi }}</p>
                    <p class="card-text"><strong>Harga Satuan:</strong> Rp {{ number_format($barang->harga_satuan, 0, ',', '.') }}</p>
                    <p class="card-text"><strong>Jumlah:</strong> {{ $barang->jumlah }}</p>
                    <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
