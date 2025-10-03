@extends('app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Detalles del Lugar</h1>

    <div class="publicar-container">
        <!-- Información básica -->
        <div class="section">
            <h3 class="sub_title tittle">Información básica</h3>
            <div class="form-grid">
                <input type="text" value="{{ $place->name }}" disabled>
                <select class="select_category" disabled>
                    <option {{ $place->place_category?->name == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                    <option {{ $place->place_category?->name == 'Restaurante' ? 'selected' : '' }}>Restaurante</option>
                    <option {{ $place->place_category?->name == 'Casa' ? 'selected' : '' }}>Casa</option>
                </select>
            </div>
            <textarea rows="4" class="text_area_description" disabled>{{ $place->description }}</textarea>
        </div>

        <!-- Ubicación -->
        <div class="section">
            <h3 class="sub_title tittle">Ubicación</h3>
            <input type="text" value="{{ $place->coordenadas ?? 'No especificadas' }}" disabled>
            <div class="mapa">[Mapa aquí]</div>
        </div>

        <!-- Características -->
        <div class="section">
            <h3 class="sub_title tittle">Características del alojamiento</h3>
            <div class="form-grid">
                <input type="text" value="{{ $place->servicios ?? '—' }}" disabled>
                <input type="text" value="{{ $place->habitaciones ?? '—' }}" disabled>
                <input type="text" value="{{ $place->capacidad ?? '—' }}" disabled>
            </div>
        </div>

        <!-- Reglas -->
        <div class="section section_reglas">
            <h3 class="sub_title tittle">Reglas y consideraciones</h3>
            <textarea rows="4" class="text_area_description" disabled>{{ $place->reglas ?? '—' }}</textarea>
        </div>

        <!-- Precios -->
        <div class="section">
            <h3 class="sub_title tittle">Precios y moneda</h3>
            <div class="form-grid">
                <input type="text" value="{{ $place->entrance_fee ?? '—' }}" disabled>
                <input type="text" value="{{ $place->currency ?? 'USD' }}" disabled>
                <input type="text" value="{{ $place->promocion ?? 'Ninguna' }}" disabled>
            </div>
        </div>

        <!-- Opciones -->
        <div class="section checkbox">
            <div class="con_check">
                <label>Público</label>
                <input type="radio" disabled {{ $place->is_public ? 'checked' : '' }}>
            </div>
            <div class="con_check">
                <label>Gestionado</label>
                <input type="radio" disabled {{ $place->is_managed ? 'checked' : '' }}>
            </div>
        </div>

<!-- Imágenes -->
<div>
    <h2 class="sub_title tittle">Imágenes</h2>
    @if(!empty($imagenes))
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($imagenes as $img)
                <img src="{{ Storage::url($img) }}"
                     alt="Imagen de {{ $place->name }}"
                     class="rounded-lg shadow">
            @endforeach
        </div>
    @else
        <p>No hay imágenes disponibles</p>
    @endif
</div>

    </div>

    <!-- Botones de acción -->
    <div class="mt-6 flex space-x-3">
        <a href="{{ route('places.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Volver</a>
        <a href="{{ route('places.edit', $place->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
        <form action="{{ route('places.destroy', $place->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Deseas eliminar este lugar?')"
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Eliminar
            </button>
        </form>
    </div>
</div>
@endsection
