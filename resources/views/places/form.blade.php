<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="publicar-container">
    @csrf
    @if($method ?? false)
        @method($method)
    @endif

    <!-- Información básica -->
    <div class="section">
        <h3 class="sub_title tittle">Información básica</h3>
        <div class="form-grid">
            <input type="text" name="name" value="{{ old('name', $place->name ?? '') }}" placeholder="Nombre del alojamiento" required>
<select class="select_category" name="categoria" >
    <option>Hotel</option>
    <option>Restaurante</option>
    <option>Casa</option>
</select>

        </div>
        <textarea name="description" rows="4" class="text_area_description" placeholder="Descripción">{{ old('description', $place->description ?? '') }}</textarea>
    </div>

    <!-- Ubicación -->
    <div class="section">
        <h3 class="sub_title tittle">Ubicación</h3>
        <input type="number" name="coordenadas" value="{{ old('coordenadas', $place->coordenadas ?? '') }}" placeholder="Coordenadas: lat, lng">
        <div class="mapa">[Mapa aquí]</div>
    </div>

    <!-- Características -->
    <div class="section">
        <h3 class="sub_title tittle">Características del alojamiento</h3>
        <div class="form-grid">
            <input type="text" name="servicios" value="{{ old('servicios', $place->servicios ?? '') }}" placeholder="Servicios incluidos">
            <input type="number" name="habitaciones" value="{{ old('habitaciones', $place->habitaciones ?? '') }}" placeholder="Número de habitaciones">
            <input type="number" name="capacidad" value="{{ old('capacidad', $place->capacidad ?? '') }}" placeholder="Capacidad de personas">
        </div>
    </div>

    <!-- Reglas -->
    <div class="section section_reglas">
        <h3 class="sub_title tittle">Reglas y consideraciones</h3>
        <textarea name="reglas" rows="4" class="text_area_description" placeholder="Descripción">{{ old('reglas', $place->reglas ?? '') }}</textarea>
    </div>

    <!-- Precios -->
    <div class="section">
        <h3 class="sub_title tittle">Precios y moneda</h3>
        <div class="form-grid">
            <input type="number" step="0.01" name="entrance_fee" value="{{ old('entrance_fee', $place->entrance_fee ?? '') }}" placeholder="Precio por noche ($)">
            <input type="text" name="currency" value="{{ old('currency', $place->currency ?? 'USD') }}" placeholder="Moneda (USD, NIO)">
            <input type="text" name="promocion" value="{{ old('promocion', $place->promocion ?? '') }}" placeholder="Descuento o promociones">
        </div>
    </div>

<!-- Opciones -->
<div class="section checkbox">
    <div class="con_check">
        <label>
            Público
        </label>
         <input type="radio" name="status" value="public"
                {{ old('status', ($place->is_public ?? true) ? 'public' : 'managed') === 'public' ? 'checked' : '' }}>
    </div>
    <div class="con_check">
        <label>
            Gestionado
        </label>
          <input type="radio" name="status" value="managed"
                {{ old('status', ($place->is_managed ?? false) ? 'managed' : 'public') === 'managed' ? 'checked' : '' }}>
    </div>
</div>


    <!-- Imágenes -->
    <div class="section">
        <h3 class="sub_title tittle">Imágenes</h3>
        <input type="file" name="imagenes[]" id="imagenes" class="upload-box" multiple>
        <div class="carousel" id="carousel" style="display:none;">
            <div class="carousel-track" id="carousel-track"></div>
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
        <h3 class="sub_title tittle">Publicar</h3>
        <p>Al publicar, tu contenido podrá ser visto por los usuarios.</p>
        <button type="submit" class="btn btn-publicar">Guardar</button>
    </div>
</form>

{{-- ====== SCRIPTS ====== --}}
<script>
/* ================== CARRUSEL ================== */
const images = [];
let currentIndex = 0;
const fileInput = document.getElementById('imagenes');
const track = document.getElementById('carousel-track');
const carousel = document.getElementById('carousel');

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

function updateCarousel(){
  track.style.transform = `translateX(-${currentIndex * 100}%)`;
}

document.getElementById('next').addEventListener('click', ()=>{
  currentIndex = (currentIndex + 1) % images.length;
  updateCarousel();
});

document.getElementById('prev').addEventListener('click', ()=>{
  currentIndex = (currentIndex - 1 + images.length) % images.length;
  updateCarousel();
});

/* ================== CALENDARIO ================== */
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

document.getElementById('prevMonth').addEventListener('click', ()=>{
  if(currentMonth===0){currentMonth=11; currentYear--;} else currentMonth--;
  renderCalendar();
});

document.getElementById('nextMonth').addEventListener('click', ()=>{
  if(currentMonth===11){currentMonth=0; currentYear++;} else currentMonth++;
  renderCalendar();
});

document.getElementById('marcarOcupado').addEventListener('click', ()=>{
  if(!selectedDay) return;
  const key = `${currentYear}-${currentMonth}`;
  if(!ocupados[key]) ocupados[key]=[];
  if(!ocupados[key].includes(selectedDay)) ocupados[key].push(selectedDay);
  selectedDay = null;
  renderCalendar();
});

document.getElementById('marcarDisponible').addEventListener('click', ()=>{
  if(!selectedDay) return;
  const key = `${currentYear}-${currentMonth}`;
  if(!ocupados[key]) return;
  ocupados[key] = ocupados[key].filter(d => d!==selectedDay);
  selectedDay = null;
  renderCalendar();
});

renderCalendar();
</script>
