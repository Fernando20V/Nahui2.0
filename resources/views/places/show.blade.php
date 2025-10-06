@extends('app')

@section('content')

    <div class="publicar-container">
            <!-- Volver -->
    <a href="{{ route('places.index') }}" class="icon-btn btn-back" title="Volver">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>

        <h1 class="place_title">Detalles del Lugar</h1>
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
<div class="section">
    <h2 class="sub_title tittle">Imágenes</h2>

    @if(!empty($imagenes) && count($imagenes) > 0)
        <div class="carousel" id="show-carousel">
            <div class="carousel-track" id="show-carousel-track">
                @foreach($imagenes as $img)
                    <div class="carousel-item">
                        <img src="{{ Storage::url($img) }}"
                             alt="Imagen de {{ $place->name }}"
                             class="rounded-lg shadow w-full h-64 object-cover">
                    </div>
                @endforeach
            </div>
            <button type="button" class="prev" id="show-prev">&#10094;</button>
            <button type="button" class="next" id="show-next">&#10095;</button>
        </div>
    @else
        <p>No hay imágenes disponibles</p>
    @endif
</div>



    </div>

<div class="action-buttons acciones_show">
    <!-- Editar -->
    <a href="{{ route('places.edit', $place->id) }}" class="icon-btn btn-edit" title="Editar">
        <i class="fa-solid fa-pen-to-square"></i> Editar
    </a>


<x-boton-eliminar :id="$place->id" />

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const track = document.getElementById("show-carousel-track");
    const items = track ? track.querySelectorAll(".carousel-item") : [];
    const prevBtn = document.getElementById("show-prev");
    const nextBtn = document.getElementById("show-next");
    let currentIndex = 0;

    if(items.length > 0){
        function updateCarousel(){
            track.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel();
        });

        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            updateCarousel();
        });

        updateCarousel();
    }
});
</script>

@endsection
