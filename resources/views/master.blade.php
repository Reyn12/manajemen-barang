<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Barang')</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Lato dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    
    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100">
    @yield('content')
    @stack('scripts')
</body>
</html>