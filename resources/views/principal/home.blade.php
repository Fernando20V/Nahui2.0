{{-- resources/views/conoce.blade.php --}}
@extends('layouts.app')

    @include('layouts.header')
@section('content')
<section class="conoce-nicaragua">
    <!-- Grid de imágenes escalonadas -->
    <div class="image-grid">
        <!-- Texto -->
        <div class="item text-content">
            <h2>Conoce Nicaragua</h2>
            <p>
                Nicaragua es un país de América Central ubicado entre el
                océano Pacífico y el mar Caribe, conocido por su
                espectacular territorio con lagos, volcanes y playas.
            </p>
        </div>

        <div class="item small">
            <img src="{{ asset('imagenes/primeraimg.png') }}" alt="Volcán" />
        </div>

        <div class="item medium">
            <img src="{{ asset('imagenes/palmera1.png') }}" alt="Playa" />
        </div>

        <div class="item small">
            <img src="{{ asset('imagenes/catedral.png') }}" alt="Catedral" />
        </div>

        <div class="item small">
            <img src="{{ asset('imagenes/primeraimg.png') }}" alt="Paisaje volcán" />
        </div>

        <div class="item large">
            <img src="{{ asset('imagenes/catedragrande.png') }}" alt="Catedral de Granada" />
        </div>

        <div class="item medium">
            <img src="{{ asset('imagenes/palmera1.png') }}" alt="Islas del Caribe" />
        </div>
    </div>
</section>
@endsection
