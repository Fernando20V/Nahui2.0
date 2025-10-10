@extends('app')

@section('content')
<section class="lugares-container">
<div class="buscador">
  <input type="text" id="searchInput" placeholder="Buscar lugar o categoría..." />
  <span class="icono-buscar"><i class="fa fa-search"></i></span>
</div>



  @foreach ($grouped as $index => $placesByCategory)
  @php
    $category = $index;
    $reverse = $loop->index % 2 !== 0; // alterna dirección
  @endphp

  <div class="categoria-section">
    <h2 class="categoria-titulo">{{ ucfirst($category) }} ></h2>
    <div class="carrusel-container {{ $reverse ? 'reverse' : '' }}">
      <div class="carrusel-track">
        @foreach ($placesByCategory as $place)
          @php
              $imagenes = $place->imagenes ?? [];
              $image = count($imagenes)
                  ? (str_starts_with($imagenes[0], 'lugares/')
                      ? asset($imagenes[0])
                      : asset('storage/'.$imagenes[0]))
                  : asset('images/default.jpg');
          @endphp

          <div class="tarjeta" data-name="{{ strtolower($place->name) }}" data-category="{{ strtolower($category) }}">
            <img src="{{ $image }}" alt="{{ $place->name }}">
            <div class="tarjeta-info">
              <h3>{{ $place->name }}</h3>
              <p>{{ $place->description }}</p>
              <span class="etiqueta">{{ ucfirst($category) }}</span>
            </div>
          </div>
        @endforeach

        {{-- 🔁 Duplicamos para loop infinito sin salto --}}
        @foreach ($placesByCategory as $place)
          @php
              $imagenes = $place->imagenes ?? [];
              $image = count($imagenes)
                  ? (str_starts_with($imagenes[0], 'lugares/')
                      ? asset($imagenes[0])
                      : asset('storage/'.$imagenes[0]))
                  : asset('images/default.jpg');
          @endphp

          <div class="tarjeta" data-name="{{ strtolower($place->name) }}" data-category="{{ strtolower($category) }}">
            <img src="{{ $image }}" alt="{{ $place->name }}">
            <div class="tarjeta-info">
              <h3>{{ $place->name }}</h3>
              <p>{{ $place->description }}</p>
              <span class="etiqueta">{{ ucfirst($category) }}</span>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach
</section>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById('searchInput');
  const cards = document.querySelectorAll('.tarjeta');

  searchInput.addEventListener('input', e => {
    const query = e.target.value.toLowerCase();
    cards.forEach(card => {
      const name = card.dataset.name;
      const category = card.dataset.category;
      card.style.display = (name.includes(query) || category.includes(query)) ? 'block' : 'none';
    });
  });
});
</script>
@endsection
