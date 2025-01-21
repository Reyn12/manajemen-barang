@extends('master')

@section('title', 'Supplier')

@section('content')
    <!-- Isi konten disini -->
    <div class="flex p-5 ">
        @include('dashboard.components.sidebar')
        
        <div class="ml-[280px] flex-1 py-4 px-8 bg-white rounded-xl mb-4">
            @include('supplier.components.header')

            @include('supplier.components.filters')

            @include('supplier.components.table')

            @include('supplier.components.modal-tambah')
        </div>
    </div>
@endsection

@push('styles')
    <!-- CSS tambahan -->
@endpush

@push('scripts')
    <!-- JavaScript tambahan -->
@endpush