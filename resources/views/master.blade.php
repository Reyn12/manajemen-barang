<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Barang')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Font Lato dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    {{-- Apex Chart --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- Custom Style --}}
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }
    </style>
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gray-50">
    @yield('content')
    @stack('scripts')
    @livewireScripts
</body>
</html>