@extends('master')

@section('title', 'Produk')

@section('content')
    <!-- Isi konten disini -->
    <div class="flex p-5 ">
        @include('dashboard.components.sidebar')
        
        <div class="ml-[280px] flex-1 py-4 px-8 bg-white rounded-xl mb-4">
            @include('produk.components.header')
            @include('produk.components.filter-produk')
            @include('produk.components.data-produk')

        </div>
    </div>
@endsection

@push('styles')
    <!-- CSS tambahan -->
@endpush

@push('scripts')
    <!-- JavaScript tambahan -->
@endpush