@extends('master')

@section('title', 'Transaksi')

@section('content')
<div class="flex p-5">
    @include('dashboard.components.sidebar')
    
    <div class="ml-[280px] flex-1 py-4 px-8 bg-white rounded-xl mb-4">
        @include('transaksi.components.header')
    </div>
</div>
@endsection