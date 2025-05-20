<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('barangs.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'kode' => 'required|string|max:10|unique:barangs,kode',
        'nama_barang' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'harga_satuan' => 'required|numeric|min:0',
        'jumlah' => 'required|integer|min:0',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
    ]);

    // Buat instance model
    $barang = new \App\Models\Barang();
    $barang->kode = $request->kode;
    $barang->nama_barang = $request->nama_barang;
    $barang->deskripsi = $request->deskripsi;
    $barang->harga_satuan = $request->harga_satuan;
    $barang->jumlah = $request->jumlah;

    // Simpan file jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('foto_barang'), $filename);
        $barang->foto = $filename;
    }

    // Simpan data ke database
    $barang->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('barangs.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('barangs.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Ambil data barang berdasarkan ID
    $barang = Barang::findOrFail($id);

    // Validasi input
    $request->validate([
        'kode' => 'required|string|max:10|unique:barangs,kode,' . $barang->id,
        'nama_barang' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'harga_satuan' => 'required|numeric|min:0',
        'jumlah' => 'required|integer|min:0',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Update field
    $barang->kode = $request->kode;
    $barang->nama_barang = $request->nama_barang;
    $barang->deskripsi = $request->deskripsi;
    $barang->harga_satuan = $request->harga_satuan;
    $barang->jumlah = $request->jumlah;

    // Cek dan update file foto jika ada upload baru
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($barang->foto && file_exists(public_path('foto_barang/' . $barang->foto))) {
            unlink(public_path('foto_barang/' . $barang->foto));
        }

        // Upload foto baru
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('foto_barang'), $filename);
        $barang->foto = $filename;
    }

    // Simpan perubahan
    $barang->save();

    // Redirect kembali ke index
    return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus file foto jika ada
        if ($barang->foto && file_exists(public_path('foto_barang/' . $barang->foto))) {
            unlink(public_path('foto_barang/' . $barang->foto));
        }

        $barang->delete();

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus');
    }
}