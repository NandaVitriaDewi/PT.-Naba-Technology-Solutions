<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'PT. Naba Technology Solutions')</title>
    <meta name="description" content="@yield('description', 'Penyedia resmi perlengkapan komputer, telekomunikasi, fotografi, suku cadang elektronik, dan peralatan dapur di Denpasar, Bali.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    {{-- Tampilan saat link dibagikan (WhatsApp, Facebook, dll) --}}
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="PT. Naba Technology Solutions">
    <meta property="og:title" content="@yield('title', 'PT. Naba Technology Solutions')">
    <meta property="og:description" content="@yield('description', 'Penyedia resmi perlengkapan komputer, telekomunikasi, fotografi, suku cadang elektronik, dan peralatan dapur di Denpasar, Bali.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/hero.jpg'))">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-white font-sans text-ink antialiased">
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>