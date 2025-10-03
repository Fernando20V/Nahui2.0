<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- Header con roles --}}
    @include('layouts.header')

    {{-- Contenido principal --}}
    <main class="container mx-auto mt-4">
        @yield('content')
    </main>
{{-- <div id="app" data-page="{{ json_encode($page) }}"></div> --}}


    {{-- alertas --}}
        @include('partials.alerts')

</body>
</html>
