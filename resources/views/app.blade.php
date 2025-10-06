<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Vite CSS y JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet CSS (Mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        /* Aislar estilos de Font Awesome del mapa */
        #map-container .fa,
        #map-container .icon {
            all: unset;
        }
    </style>
</head>
<body class="body">

    @include('layouts.header')
    {{-- Header --}}

    {{-- Contenido principal --}}
    <main class="main">
        @yield('content')
    </main>

    @include('partials.alerts')

    {{-- Scripts adicionales --}}
    @yield('scripts')
    @stack('scripts')

</body>
</html>
