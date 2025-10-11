@extends('app')

@section('content')
<section class="lugares-container">
  {{-- 🔍 Buscador --}}
  <div class="buscador">
    <input type="text" id="searchInput" placeholder="Buscar lugar, categoría o departamento..." />
    <span class="icono-buscar"><i class="fa fa-search"></i></span>
  </div>

  {{-- ===================== CATEGORÍAS ===================== --}}
  @foreach ($byCategory as $category => $places)
    @php $reverse = $loop->index % 2 !== 0; @endphp
    <div class="categoria-section">
      <h2 class="categoria-titulo">{{ ucfirst($category) }} ></h2>
      <div class="carrusel-container {{ $reverse ? 'reverse' : '' }}">
        <div class="carrusel-track">
          @foreach ($places as $place)
            @php
              $imagenes = $place->imagenes ?? [];
              $image = count($imagenes)
                ? (str_starts_with($imagenes[0], 'lugares/') ? asset($imagenes[0]) : asset('storage/'.$imagenes[0]))
                : asset('images/default.jpg');
            @endphp

            <div class="tarjeta" 
                 data-name="{{ strtolower($place->name) }}" 
                 data-category="{{ strtolower($category) }}" 
                 data-department="{{ strtolower($place->department->name ?? '') }}"
                 onclick="window.location='{{ route('places.reservar', $place->id) }}'">
              <img src="{{ $image }}" alt="{{ $place->name }}">
              <div class="tarjeta-info">
                <h3>{{ $place->name }}</h3>
                <p>{{ $place->description }}</p>
                <span class="etiqueta">{{ ucfirst($category) }}</span>
              </div>
            </div>
          @endforeach

          {{-- duplicado para scroll infinito --}}
          @foreach ($places as $place)
            @php
              $imagenes = $place->imagenes ?? [];
              $image = count($imagenes)
                ? (str_starts_with($imagenes[0], 'lugares/') ? asset($imagenes[0]) : asset('storage/'.$imagenes[0]))
                : asset('images/default.jpg');
            @endphp

            <div class="tarjeta" 
                 data-name="{{ strtolower($place->name) }}" 
                 data-category="{{ strtolower($category) }}" 
                 data-department="{{ strtolower($place->department->name ?? '') }}"
                 onclick="window.location='{{ route('places.reservar', $place->id) }}'">
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


  {{-- ===================== DEPARTAMENTOS ===================== --}}
  @foreach ($byDepartment as $department => $places)
    @php $reverse = $loop->index % 2 !== 0; @endphp
    <div class="categoria-section">
      <h2 class="categoria-titulo">Lugares en {{ ucfirst($department) }} ></h2>
      <div class="carrusel-container {{ $reverse ? 'reverse' : '' }}">
        <div class="carrusel-track">
          @foreach ($places as $place)
            @php
              $imagenes = $place->imagenes ?? [];
              $image = count($imagenes)
                ? (str_starts_with($imagenes[0], 'lugares/') ? asset($imagenes[0]) : asset('storage/'.$imagenes[0]))
                : asset('images/default.jpg');
            @endphp

            <div class="tarjeta" 
                 data-name="{{ strtolower($place->name) }}" 
                 data-category="{{ strtolower($place->placeCategory->name ?? '') }}" 
                 data-department="{{ strtolower($department) }}"
                 onclick="window.location='{{ route('places.reservar', $place->id) }}'">
              <img src="{{ $image }}" alt="{{ $place->name }}">
              <div class="tarjeta-info">
                <h3>{{ $place->name }}</h3>
                <p>{{ $place->description }}</p>
                <span class="etiqueta">{{ ucfirst($place->placeCategory->name ?? 'Otros') }}</span>
              </div>
            </div>
          @endforeach

          {{-- duplicado scroll infinito --}}
          @foreach ($places as $place)
            @php
              $imagenes = $place->imagenes ?? [];
              $image = count($imagenes)
                ? (str_starts_with($imagenes[0], 'lugares/') ? asset($imagenes[0]) : asset('storage/'.$imagenes[0]))
                : asset('images/default.jpg');
            @endphp

            <div class="tarjeta" 
                 data-name="{{ strtolower($place->name) }}" 
                 data-category="{{ strtolower($place->placeCategory->name ?? '') }}" 
                 data-department="{{ strtolower($department) }}"
                 onclick="window.location='{{ route('places.reservar', $place->id) }}'">
              <img src="{{ $image }}" alt="{{ $place->name }}">
              <div class="tarjeta-info">
                <h3>{{ $place->name }}</h3>
                <p>{{ $place->description }}</p>
                <span class="etiqueta">{{ ucfirst($place->placeCategory->name ?? 'Otros') }}</span>
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
      const department = card.dataset.department;
      card.style.display =
        (name.includes(query) || category.includes(query) || department.includes(query))
        ? 'block' : 'none';
    });
  });
});
</script>
@endsection
