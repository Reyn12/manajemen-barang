<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;



class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Transaksi::query();
        
        if ($search) {
            $query->whereHas('produk', function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%");
            })
            ->orWhere('id_transaksi', 'like', "%{$search}%");
        }
        
        $transaksis = $query->latest()->paginate(10);
        $produks = Produk::all();
    
        return view('transaksi.transaksi', [
            'transaksis' => $transaksis,
            'produks' => $produks,
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
            'status_bayar' => 'required|in:Pending,Sukses,Gagal',
        ]);
    
        try {
            // Generate kode transaksi
            $validated['kode_transaksi'] = Transaksi::generateKodeTransaksi();
            
            // Simpan transaksi
            Transaksi::create($validated);
    
            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error creating transaction: ' . $e->getMessage());
            
            return redirect()->route('transaksi.index')
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
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $produks = Produk::all();

        return view('transaksi.edit', [
            'transaksi' => $transaksi,
            'produks' => $produks,
            'title' => 'Edit Transaksi'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        $request->validate([
            'id_produk' => 'required',
            'jumlah' => 'required|numeric',
            'tgl_jual' => 'required|date',
            'status_bayar' => 'required'
        ]);
    
        $produk = Produk::findOrFail($request->id_produk);
        $total_harga = $produk->harga * $request->jumlah;
    
        $transaksi->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tgl_jual' => $request->tgl_jual,
            'total_harga' => $total_harga,
            'status_bayar' => $request->status_bayar
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data transaksi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data transaksi'
            ], 500);
        }
    }
    
    public function export() 
    {
        return Excel::download(new TransaksiExport, 'transaksi_' . date('Y-m-d') . '.xlsx');
    }

    public function downloadPDF()
    {
        $transaksis = Transaksi::with('produk')->get();
        $pdf = Pdf::loadView('transaksi.export.pdf', compact('transaksis'));
        return $pdf->download('transaksi.pdf');
    }

    public function downloadExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}
