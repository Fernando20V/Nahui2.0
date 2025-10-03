@extends('layouts.app')

@section('content')
<div id="map-app" class="h-[600px] flex flex-col md:flex-row gap-4">
    {{-- Panel izquierdo: filtros y tarjetas --}}
    <aside class="w-full md:w-1/3 bg-white p-4 rounded shadow">
        <input type="text" placeholder="Buscar por nombre o tipo..." id="search" class="w-full mb-2 p-2 border rounded">

        <div class="flex space-x-2 mb-2">
            <button data-type="" class="filter-btn bg-gray-200 px-2 py-1 rounded">Todos</button>
            <button data-type="hoteles" class="filter-btn bg-gray-200 px-2 py-1 rounded">Hoteles</button>
            <button data-type="restaurantes" class="filter-btn bg-gray-200 px-2 py-1 rounded">Restaurantes</button>
            <button data-type="fincas" class="filter-btn bg-gray-200 px-2 py-1 rounded">Fincas</button>
        </div>

        <div id="cards" class="space-y-2"></div>
    </aside>

    {{-- Mapa --}}
    <div class="w-full md:w-2/3 h-[600px] rounded shadow">
        <div id="map" class="h-full w-full"></div>
    </div>
</div>
@endsection
