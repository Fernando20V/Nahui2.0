<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method ?? false)
        @method($method)
    @endif

    <a href="{{ route('places.index') }}" class="icon-btn btn-back" title="Volver">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>

    <!-- Información básica -->
    <div class="section">
        <h3 class="sub_title tittle">Información básica</h3>
        <div class="form-grid">
            <input type="text" name="name" value="{{ old('name', $place->name ?? '') }}"
                placeholder="Nombre del alojamiento" required>
   <select class="select_category" name="categoria" required>
            <option value="">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @if(old('categoria', $place->place_category_id ?? '') == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>



        </div>
        <textarea name="description" rows="4" class="text_area_description"
            placeholder="Descripción">{{ old('description', $place->description ?? '') }}</textarea>
    </div>

    <!-- Coordenadas -->
    <label class="sub_title" for="direccion">Coordenadas</label>
    <div class="coordenadas">
        <div class="section">
            <h3 class="sub_title tittle">Longitud</h3>
            <input class="ubicacion" type="text"  name="longitude"
                value="{{ old('longitude', $place->longitude ?? '') }}" placeholder="Coordenadas: lng">
        </div>
        <div class="section">
            <h3 class="sub_title tittle">Latitud</h3>
            <input class="ubicacion" type="text"  name="latitude"
                value="{{ old('latitude', $place->latitude ?? '') }}" placeholder="Latitud: lat">
        </div>
        <div class="mapa" id="map-container">
            <div id="map" style="height: 350px; border-radius: 10px; margin-top: 10px;"></div>
        </div>
    </div>

    <!-- Características -->
    <div class="section">
        <h3 class="sub_title tittle">Características del alojamiento</h3>
        <div class="form-grid">
            <input type="text" name="servicios" value="{{ old('servicios', $place->servicios ?? '') }}"
                placeholder="Servicios incluidos">
            <input type="number" name="habitaciones" value="{{ old('habitaciones', $place->habitaciones ?? '') }}"
                placeholder="Número de habitaciones">
            <input type="number" name="capacidad" value="{{ old('capacidad', $place->capacidad ?? '') }}"
                placeholder="Capacidad de personas">
        </div>
    </div>

    <!-- Reglas -->
    <div class="section section_reglas">
        <h3 class="sub_title tittle">Reglas y consideraciones</h3>
        <textarea name="reglas" rows="4" class="text_area_description"
            placeholder="Descripción">{{ old('reglas', $place->reglas ?? '') }}</textarea>
    </div>

    <!-- Precios -->
    <div class="section">
        <h3 class="sub_title tittle">Precios y moneda</h3>
        <div class="form-grid">
            <input type="number" step="0.01" name="entrance_fee"
                value="{{ old('entrance_fee', $place->entrance_fee ?? '') }}" placeholder="Precio por noche ($)">
            <input type="text" name="currency" value="{{ old('currency', $place->currency ?? 'USD') }}"
                placeholder="Moneda (USD, NIO)">
            <input type="text" name="promocion" value="{{ old('promocion', $place->promocion ?? '') }}"
                placeholder="Descuento o promociones">
                    <input type="text" name="hours" value="{{ old('hours', $place->hours ?? '') }}"
                placeholder="Horario">
        </div>
    </div>

    <!-- Opciones -->
    <div class="section checkbox">
        <div class="con_check">
            <label>Público</label>
            <input type="radio" name="status" value="public"
                {{ old('status', ($place->is_public ?? true) ? 'public' : 'managed') === 'public' ? 'checked' : '' }}>
        </div>
        <div class="con_check">
            <label>Gestionado</label>
            <input type="radio" name="status" value="managed"
                {{ old('status', ($place->is_managed ?? false) ? 'managed' : 'public') === 'managed' ? 'checked' : '' }}>
        </div>
    </div>
<!-- Imágenes -->
<div class="section">
    <h3 class="sub_title tittle">Imágenes</h3>
    
    <!-- Input para subir nuevas imágenes -->
    <input type="file" name="imagenes[]" id="imagenes" class="upload-box" multiple>

    <!-- Carousel para mostrar imágenes existentes -->
    <div class="carousel" id="carousel" style="{{ !empty($place->imagenes) && count($place->imagenes) > 0 ? 'display:block;' : 'display:none;' }}">
        <div class="carousel-track" id="carousel-track">
            @if(!empty($place->imagenes))
                @foreach($place->imagenes as $imagen)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/'.$imagen) }}" alt="Imagen del lugar">
                    </div>
                @endforeach
            @endif
        </div>
        <button type="button" class="prev" id="prev">&#10094;</button>
        <button type="button" class="next" id="next">&#10095;</button>
    </div>
</div>


    <!-- Disponibilidad -->
    <div class="section section_calendar">
        <div class="estado">
            <button type="button" class="btn" id="marcarDisponible">Disponible</button>
            <button type="button" class="btn" id="marcarOcupado">Ocupado</button>
        </div>
        <div class="calendario-header">
            <button type="button" id="prevMonth">◀</button>
            <span id="monthYear"></span>
            <button type="button" id="nextMonth">▶</button>
        </div>
        <div class="calendar" id="calendar"></div>
    </div>

    <!-- Publicar -->
    <div class="section publicar">
        <h3 class="sub_title tittle tittlpubli">Publicar</h3>
        <p>Al publicar, tu contenido podrá ser visto por los usuarios.</p>
        <button type="submit" class="btn btn-publicar">Guardar</button>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ================== MAPA ==================
    const defaultLat = 12.1364;
    const defaultLng = -86.2514;

    const existingLat = parseFloat("{{ $place->latitude ?? '0' }}");
    const existingLng = parseFloat("{{ $place->longitude ?? '0' }}");

    const map = L.map('map').setView(
        (existingLat && existingLng) ? [existingLat, existingLng] : [defaultLat, defaultLng],
        14
    );

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const placeIcon = L.divIcon({
        html: '<i class="fa-solid fa-location-dot" style="color:red; font-size:22px;"></i>',
        iconSize: [24, 24],
        iconAnchor: [12, 24]
    });

    let marker;
    if (existingLat && existingLng) {
        marker = L.marker([existingLat, existingLng], { icon: placeIcon })
            .addTo(map)
            .bindPopup("Ubicación actual")
            .openPopup();
    }

    map.on('click', function(e){
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        if(marker) map.removeLayer(marker);

        marker = L.marker([lat,lng], { icon: placeIcon })
            .addTo(map)
            .bindPopup(`Lat: ${lat}, Lng: ${lng}`)
            .openPopup();

        document.querySelector('input[name="latitude"]').value = lat;
        document.querySelector('input[name="longitude"]').value = lng;
    });

    setTimeout(()=> map.invalidateSize(), 300);

    // ================== CARRUSEL ==================
    const images = [];
    let currentIndex = 0;
    const fileInput = document.getElementById('imagenes');
    const track = document.getElementById('carousel-track');
    const carousel = document.getElementById('carousel');

    if(fileInput){
        fileInput.addEventListener('change', function(event){
            const files = event.target.files;
            track.innerHTML = '';
            images.length = 0;

            for(let i=0; i<files.length; i++){
                const url = URL.createObjectURL(files[i]);
                images.push(url);
                const div = document.createElement('div');
                div.className = 'carousel-item';
                const img = document.createElement('img');
                img.src = url;
                div.appendChild(img);
                track.appendChild(div);
            }

            currentIndex = 0;
            updateCarousel();
            carousel.style.display = 'block';
        });
    }

    function updateCarousel(){
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    document.getElementById('next')?.addEventListener('click', ()=>{
        currentIndex = (currentIndex + 1) % images.length;
        updateCarousel();
    });
    document.getElementById('prev')?.addEventListener('click', ()=>{
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateCarousel();
    });

    // ================== CALENDARIO ==================
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let selectedDay = null;
    const ocupados = {};

    const calendar = document.getElementById('calendar');
    const monthYear = document.getElementById('monthYear');

    function daysInMonth(month, year){
        return Array.from({length: new Date(year, month+1,0).getDate()}, (_, i)=>i+1);
    }

    function renderCalendar(){
        monthYear.textContent = `${currentMonth+1} / ${currentYear}`;
        calendar.innerHTML = '';
        const days = daysInMonth(currentMonth, currentYear);
        days.forEach(d => {
            const div = document.createElement('div');
            div.className = 'day';
            div.textContent = d;

            const key = `${currentYear}-${currentMonth}`;
            if(ocupados[key]?.includes(d)) div.classList.add('ocupado');
            if(selectedDay === d) div.classList.add('seleccionado');

            div.addEventListener('click', ()=> {
                selectedDay = d;
                renderCalendar();
            });

            calendar.appendChild(div);
        });
    }

    document.getElementById('prevMonth')?.addEventListener('click', ()=>{
        if(currentMonth===0){currentMonth=11; currentYear--;} else currentMonth--;
        renderCalendar();
    });
    document.getElementById('nextMonth')?.addEventListener('click', ()=>{
        if(currentMonth===11){currentMonth=0; currentYear++;} else currentMonth++;
        renderCalendar();
    });

    document.getElementById('marcarOcupado')?.addEventListener('click', ()=>{
        if(!selectedDay) return;
        const key = `${currentYear}-${currentMonth}`;
        if(!ocupados[key]) ocupados[key]=[];
        if(!ocupados[key].includes(selectedDay)) ocupados[key].push(selectedDay);
        selectedDay = null;
        renderCalendar();
    });

    document.getElementById('marcarDisponible')?.addEventListener('click', ()=>{
        if(!selectedDay) return;
        const key = `${currentYear}-${currentMonth}`;
        if(!ocupados[key]) return;
        ocupados[key] = ocupados[key].filter(d => d!==selectedDay);
        selectedDay = null;
        renderCalendar();
    });

    renderCalendar();

});
</script>
@endpush
