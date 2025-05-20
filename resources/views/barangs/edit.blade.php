@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Barang</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode', $barang->kode) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="number" name="harga_satuan" class="form-control" id="harga_satuan" value="{{ old('harga_satuan', $barang->harga_satuan) }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" id="jumlah" value="{{ old('jumlah', $barang->jumlah) }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label><br>
            @if ($barang->foto)
                <img src="{{ asset('foto_barang/' . $barang->foto) }}" alt="Foto" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
            <small>Kosongkan jika tidak ingin mengganti foto</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
