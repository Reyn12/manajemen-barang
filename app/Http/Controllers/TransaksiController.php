<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $transaksis = Transaksi::latest()->paginate(10);
        $produks = Produk::all(); // Tambah ini
    
        return view('transaksi.transaksi', [
            'transaksis' => $transaksis,
            'produks' => $produks, // Tambah ini
            'title' => 'Transaksi'
        ]);
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
        // Validasi input
        $validated = $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'tgl_jual' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'status_bayar' => 'required|in:Pending,Sukses,Gagal', // sesuaikan dengan enum di database
        ]);
    
        try {
            // Simpan transaksi
            Transaksi::create($validated);
    
            return redirect()->route('transaksi')
                ->with('success', 'Transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error creating transaction: ' . $e->getMessage());
            
            return redirect()->route('transaksi')
                ->with('error', 'Gagal menambahkan transaksi! Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
