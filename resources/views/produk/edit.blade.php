@extends('master')

@section('title', 'Edit Produk')

@section('content')
    <div class="flex p-5">
        @include('dashboard.components.sidebar')
        
        <div class="ml-[280px] flex-1 py-4 px-8 bg-white rounded-xl mb-4">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Produk</h1>
            </div>

            <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="HP" {{ $produk->kategori == 'HP' ? 'selected' : '' }}>HP</option>
                            <option value="Laptop" {{ $produk->kategori == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                            <option value="Tablet" {{ $produk->kategori == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                            <option value="Aksesoris" {{ $produk->kategori == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                        <select name="id_supplier" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id_supplier }}" {{ $produk->id_supplier == $supplier->id_supplier ? 'selected' : '' }}>
                                    {{ $supplier->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                        <input type="number" name="harga" value="{{ $produk->harga }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                        <input type="number" name="stok" value="{{ $produk->stok }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Spesifikasi</label>
                        <textarea name="spesifikasi" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ $produk->spesifikasi }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Produk</label>
                        <input type="file" name="foto_produk" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('produk.produk') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection