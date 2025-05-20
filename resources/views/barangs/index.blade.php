@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Barang</h2>
    <a href="{{ route('barangs.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $barang)
            <tr>
                <td>{{ $barang->kode }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ Str::limit($barang->deskripsi, 50) }}</td>
                <td>Rp {{ number_format($barang->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>
                    @if ($barang->foto)
                        <img src="{{ asset('foto_barang/' . $barang->foto) }}" alt="Foto" width="80">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('barangs.show', $barang->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus data?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Tidak ada data barang.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
