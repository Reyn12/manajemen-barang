<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $produk = Produk::with('supplier')->get();  // tambahkan ini kembali
        return view('produk.produk', compact('suppliers', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'id_supplier' => 'required',
            'harga' => 'required|numeric|min:0',
            'spesifikasi' => 'nullable',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stok' => 'required|numeric|min:0'
        ]);

        // Handle foto upload
        $foto_path = null;
        if ($request->hasFile('foto_produk')) {
            $foto = $request->file('foto_produk');
            $foto_path = $foto->store('produk', 'public');
        }

        // Simpan data produk
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'id_supplier' => $request->id_supplier,
            'harga' => $request->harga,
            'spesifikasi' => $request->spesifikasi,
            'foto_produk' => $foto_path,
            'stok' => $request->stok
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) // Ubah dari (Produk $produk) jadi ($id)
    {
        $produk = Produk::findOrFail($id);
        $suppliers = Supplier::all();
        return view('produk.edit', compact('produk', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
