@extends('app')

@section('content')
<div class="mapa-interactivo">

  {{-- 🔹 Título y buscador --}}
  <div class="top-row">
    <div>
      <h2 class="titulo">Mapa Interactivo</h2>
    </div>

    {{-- 🔎 Buscador --}}
    <div class="health-search">
      <input type="text" id="searchInput" class="search-input" placeholder="Buscar lugares...">
      <ul id="resultsList" class="results-list" style="display: none;"></ul>
    </div>
  </div>

  {{-- 🔹 Layout principal --}}
  <div class="map-layout">

    {{-- Panel lateral --}}
    <div class="panel">
      <div class="filters">
        <button class="filter-btn active" data-category="todos">Todos</button>
        <button class="filter-btn" data-category="restaurantes">Restaurantes</button>
        <button class="filter-btn" data-category="alojamientos">Alojamientos</button>
        <button class="filter-btn" data-category="hoteles">Hoteles</button>
      </div>

      <div class="cards-list" id="placesList">
        @foreach($places as $place)
        <div class="card"
             data-id="{{ $place->id }}"
             data-lat="{{ $place->latitude }}"
             data-lng="{{ $place->longitude }}"
             data-name="{{ $place->name }}"
             data-description="{{ $place->description }}"
             data-images='@json($place->imagenes ?? [])'
             data-category="{{ strtolower($place->placeCategory->name ?? 'otros') }}">
          
          @php
              $imagenes = $place->imagenes ?? [];
              if(count($imagenes)) {
                  if(str_starts_with($imagenes[0], 'lugares/')) {
                      $imagePath = asset($imagenes[0]);
                  } else {
                      $imagePath = asset('storage/' . $imagenes[0]);
                  }
              } else {
                  $imagePath = asset('images/default.jpg');
              }
          @endphp
          <img src="{{ $imagePath }}" class="card-img" alt="{{ $place->name }}">

          <div class="card-info">
            <p class="card-title">{{ $place->name }}</p>
            <div class="card-stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
            </div>
            <p class="card-desc">{{ $place->description ?? 'Sin descripción' }}</p>
            <p class="card-status open">Abierto • Cierra a las 2:00pm</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Contenedor del mapa --}}
    <div id="map" style="height: 75vh;"></div>
  </div>

  {{-- 🔹 Resumen de ruta --}}
  <div class="route-summary" id="routeSummary" style="display:none;">
    <div class="summary-item">
      <i class="fa-solid fa-road"></i> <span>Distancia: <strong id="distance">0 km</strong></span>
    </div>
    <div class="summary-item">
      <i class="fa-solid fa-clock"></i> <span>Duración: <strong id="duration">0 min</strong></span>
    </div>
  </div>

  {{-- 🔹 Modal de lugar --}}
  <div id="placeModal" class="place-modal" style="display:none;">
    <div class="modal-content">
      <span id="modalClose" class="modal-close">&times;</span>
      <h3 id="modalName"></h3>
      <img id="modalImage" src="" alt="Imagen del lugar" style="max-width:100%; height:auto; border-radius:8px;">
      <p id="modalDesc"></p>
      <p><strong>Distancia:</strong> <span id="modalDistance">0 km</span></p>
      <p><strong>Tiempo estimado:</strong> <span id="modalDuration">0 min</span></p>
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // datos pasados desde Laravel
  const places = @json($places);

  // mapa
  const map = L.map('map').setView([13.094551771400123, -86.36932020454483], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // icono usuario
  const userIcon = L.divIcon({
    html: '<i class="fa-solid fa-location-arrow" style="color: #2563eb; font-size: 20px;"></i>',
    className: 'leaflet-div-icon my-div-icon',
    iconSize: [24,24],
    iconAnchor: [12,24]
  });
  const userCoords = [13.094551771400123, -86.36932020454483];
  L.marker(userCoords, { icon: userIcon }).addTo(map).bindPopup('Tu ubicación');

  // colores por categoría (usa #)
  const iconColors = {
    restaurantes: '#d68c00',
    hoteles: '#ef4444',
    alojamientos: '#10b981',
    otros: '#2563eb'
  };

  // seleccionar cards del DOM (coinciden con places)
  const cards = Array.from(document.querySelectorAll('.card'));
  const markers = [];

  // helper: obtener categoría normalizada desde objeto place o desde card dataset
  const getCategoryFromPlace = (place, card) => {
    if (place && place.placeCategory && place.placeCategory.name) return String(place.placeCategory.name).toLowerCase();
    if (card && card.dataset && card.dataset.category) return card.dataset.category.toLowerCase();
    return 'otros';
  };

  // crear marker por cada card (más robusto que confiar solo en places[] si algunas relaciones faltan)
  cards.forEach((card, idx) => {
    const lat = parseFloat(card.dataset.lat);
    const lng = parseFloat(card.dataset.lng);
    if (Number.isNaN(lat) || Number.isNaN(lng)) return; // evita marcadores vacíos
    // buscar place correspondiente en el array (por id si existe)
    const id = card.dataset.id ? String(card.dataset.id) : null;
    const placeObj = id ? places.find(p => String(p.id) === id) : null;
    const category = getCategoryFromPlace(placeObj, card);
    const color = iconColors[category] ?? iconColors.otros;
    const marker = L.marker([lat, lng], {
      icon: L.divIcon({
        html: `<i class="fa-solid fa-map-marker-alt" style="color: ${color}; font-size:22px;"></i>`,
        className: 'leaflet-div-icon my-div-icon', // clase para quitar fondo/borde
        iconSize: [22,22],
        iconAnchor: [11,22]
      })
    }).addTo(map);

    // guardar metadata
    const placeData = placeObj ?? {
      id: id ?? idx,
      name: card.dataset.name,
      description: card.dataset.description,
      latitude: lat,
      longitude: lng,
      imagenes: JSON.parse(card.dataset.images || '[]')
    };
    marker.placeData = placeData;
    marker.category = category;
    marker.card = card;

    marker.on('click', () => {
      map.setView([lat, lng], 15);
      openPlaceModal(marker.placeData);
    });

    markers.push(marker);
  });

  // =================================================
  // filtros & búsqueda (mantener estado coherente)
  // =================================================
  const filterBtns = Array.from(document.querySelectorAll('.filter-btn'));
  const searchInput = document.getElementById('searchInput');
  const resultsList = document.getElementById('resultsList');

  let currentCategory = 'todos';

  function applyFilters() {
    const q = (searchInput.value || '').trim().toLowerCase();

    // tarjetas
    cards.forEach(card => {
      const name = (card.dataset.name || '').toLowerCase();
      const cat = (card.dataset.category || 'otros').toLowerCase();
      const matchCategory = (currentCategory === 'todos') || (cat === currentCategory);
      const matchQuery = q.length === 0 || name.includes(q);
      card.style.display = (matchCategory && matchQuery) ? 'flex' : 'none';
    });

    // marcadores: mostrar/ocultar según ambos filtros
    markers.forEach(m => {
      const matchesCategory = (currentCategory === 'todos') || (m.category === currentCategory);
      const matchesQuery = q.length === 0 || (m.placeData.name && m.placeData.name.toLowerCase().includes(q));
      if (matchesCategory && matchesQuery) {
        if (!map.hasLayer(m)) m.addTo(map);
      } else {
        if (map.hasLayer(m)) map.removeLayer(m);
      }
    });
  }

  // click en botones de categoría
  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentCategory = (btn.dataset.category || 'todos').toLowerCase();
      applyFilters();
      // centrar en primer visible si existe
      const firstVisibleCard = cards.find(c => c.style.display === 'flex');
      if (firstVisibleCard) {
        const lat = parseFloat(firstVisibleCard.dataset.lat);
        const lng = parseFloat(firstVisibleCard.dataset.lng);
        if (!Number.isNaN(lat) && !Number.isNaN(lng)) map.setView([lat, lng], 13);
      }
    });
  });

  // =================================================
  // BUSCADOR: filtra y muestra lista
  // =================================================
  searchInput.addEventListener('input', function () {
    const q = this.value.trim().toLowerCase();
    resultsList.innerHTML = '';

    if (q.length === 0) {
      resultsList.style.display = 'none';
      applyFilters();
      return;
    }

    // filtrar usando "places" array para obtener lat/lng seguras
    const filtered = places.filter(p => p.name && p.name.toLowerCase().includes(q));

    if (filtered.length === 0) {
      resultsList.style.display = 'none';
      applyFilters(); // ocultar marcadores que no matcheen
      return;
    }

    filtered.forEach(p => {
      const li = document.createElement('li');
      li.textContent = p.name;
      li.className = 'result-item';
      li.addEventListener('click', () => {
        // centrar y abrir modal usando datos del objeto p
        const lat = parseFloat(p.latitude);
        const lng = parseFloat(p.longitude);
        if (!Number.isNaN(lat) && !Number.isNaN(lng)) {
          map.setView([lat, lng], 15);
          openPlaceModal(p);
        }
        resultsList.style.display = 'none';
        searchInput.value = '';
        applyFilters(); // reset filtro visual
      });
      resultsList.appendChild(li);
    });

    // Mostrar lista y, además, limitar marcadores visibles a matches + currentCategory
    resultsList.style.display = 'block';

    // aplicar filtros inmediatamente para centrar la vista de búsqueda (markers/cards)
    applyFilters();
  });

  // click fuera para ocultar resultados
  document.addEventListener('click', function (e) {
    if (!resultsList.contains(e.target) && e.target !== searchInput) {
      resultsList.style.display = 'none';
    }
  });

  // =================================================
  // Modal y utilidades
  // =================================================
  const modal = document.getElementById('placeModal');
  const modalClose = document.getElementById('modalClose');
  const modalName = document.getElementById('modalName');
  const modalDesc = document.getElementById('modalDesc');
  const modalImage = document.getElementById('modalImage');
  const modalDistance = document.getElementById('modalDistance');
  const modalDuration = document.getElementById('modalDuration');

  function haversine(lat1, lon1, lat2, lon2) {
    const R = 6371; // km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) ** 2 +
      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
      Math.sin(dLon / 2) ** 2;
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
  }

  function openPlaceModal(place) {
    modal.style.display = 'block';
    modalName.textContent = place.name ?? 'Sin nombre';
    modalDesc.textContent = place.description ?? 'Sin descripción';

    const images = place.imagenes ?? [];
    if (images.length) {
      let path = images[0];
      if (typeof path === 'string' && path.startsWith('lugares/')) path = '/' + path;
      else path = '/storage/' + path;
      modalImage.src = path;
    } else {
      modalImage.src = '/images/default.jpg';
    }

    const dist = haversine(userCoords[0], userCoords[1], parseFloat(place.latitude), parseFloat(place.longitude));
    modalDistance.textContent = isNaN(dist) ? '0 km' : dist.toFixed(2) + ' km';
    const avgSpeed = 30; // km/h
    const duration = isNaN(dist) ? 0 : (dist / avgSpeed * 60);
    modalDuration.textContent = Math.max(0, Math.ceil(duration)) + ' min';
  }

  modalClose.addEventListener('click', () => modal.style.display = 'none');

  // click en tarjetas (abrir modal)
  cards.forEach(card => {
    card.addEventListener('click', () => {
      const lat = parseFloat(card.dataset.lat);
      const lng = parseFloat(card.dataset.lng);
      const placeData = {
        id: card.dataset.id,
        name: card.dataset.name,
        description: card.dataset.description,
        imagenes: JSON.parse(card.dataset.images || '[]'),
        latitude: lat,
        longitude: lng
      };
      map.setView([lat, lng], 15);
      openPlaceModal(placeData);
    });
  });

  // ejecutar filtros iniciales (para que desaparezcan marcadores que no correspondan si hay categoría activa)
  applyFilters();

  // asegurar render correcto del mapa
  setTimeout(() => map.invalidateSize(), 400);
});
</script>

<style>
/* elimina borde/cuadro blanco por defecto de leaflet div icons */
.leaflet-div-icon.my-div-icon {
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
}

/* estilos simples para el buscador/dropdown */
.health-search { position: relative; }
.search-input {
  padding: 8px 10px;
  border-radius: 6px;
  border: 1px solid #ddd;
  width: 26%;
  color: #d97d48;
}
.results-list {
  position: absolute;
  top: 38px;
  left: 0;
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 6px;
  width: 220px;
  max-height: 240px;
  overflow-y: auto;
  z-index: 9999;
  padding: 0;
  margin: 0;
  list-style: none;
}
.results-list .result-item {
  padding: 8px 10px;
  cursor: pointer;
}
.results-list .result-item:hover {
  background: #f3f4f6;
}
</style>
@endsection
