@extends('app')

@section('content')
<div class="detalle-container">

    {{-- ALERTA DE ÉXITO --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ENCABEZADO --}}
    <section class="encabezado">
        <h2 class="titulo">{{ $place->name }}</h2>
        <h3 class="subtitulo">{{ $place->placeCategory->name ?? '' }}</h3>
    </section>

    {{-- GALERÍA --}}
    @php $imagenes = $place->imagenes ?? []; @endphp
    <div class="galeria">
        @foreach($imagenes as $i => $img)
            @php
                $image = str_starts_with($img, 'lugares/') ? asset($img) : asset('storage/'.$img);
            @endphp
            <img src="{{ $image }}" alt="Foto {{ $i+1 }}" class="{{ $i === 0 ? 'active' : '' }}">
        @endforeach
    </div>

    {{-- DESCRIPCIÓN --}}
    <p class="descripcion">{{ $place->description ?? 'Sin descripción disponible' }}</p>

    {{-- HORARIO --}}
    @if(!empty($place->hours))
    <div class="horario">
        <strong>Horario:</strong> {{ $place->hours }}
    </div>
    @endif

    {{-- UBICACIÓN --}}
    @if($place->latitude && $place->longitude)
    <div class="ubicacion-box">
        <h4>Ubicación</h4>
        <iframe
            width="100%"
            height="250"
            style="border-radius:10px;border:none;"
            src="https://www.google.com/maps?q={{ $place->latitude }},{{ $place->longitude }}&hl=es&z=15&output=embed"
            allowfullscreen>
        </iframe>
    </div>
    @endif

    {{-- INFO GRID --}}
    <div class="info-grid">

        {{-- CALENDARIO --}}
        <div class="calendario-box">
            <div class="cal-header">
                <h4>Reservaciones</h4>
                <div class="month-nav">
                    <button id="prevMonth">‹</button>
                    <div id="monthTitle"></div>
                    <button id="nextMonth">›</button>
                </div>
            </div>
            <div class="weekdays">
                @foreach(['Lu','Ma','Mi','Ju','Vi','Sa','Do'] as $d)
                    <div class="wd">{{ $d }}</div>
                @endforeach
            </div>
            <div class="calendario" id="calendarGrid"></div>
        </div>

        {{-- CARACTERÍSTICAS Y REGLAS --}}
        <div class="textos-box">

            {{-- CARACTERÍSTICAS --}}
            @if(!empty($place->servicios) || !empty($place->habitaciones) || !empty($place->capacidad))
            <div class="caracteristicas-box">
                <h4>Características del alojamiento</h4>
                <ul>
                    @if(!empty($place->servicios))
                        <li><strong>Servicios:</strong> {{ $place->servicios }}</li>
                    @endif
                    @if(!empty($place->habitaciones))
                        <li><strong>Habitaciones:</strong> {{ $place->habitaciones }}</li>
                    @endif
                    @if(!empty($place->capacidad))
                        <li><strong>Capacidad:</strong> {{ $place->capacidad }} persona(s)</li>
                    @endif
                </ul>
            </div>
            @endif

            {{-- REGLAS --}}
            @if(!empty($place->reglas))
            <div class="reglas-box">
                <h4>Reglas y consideraciones</h4>
                <p>{{ $place->reglas }}</p>
            </div>
            @endif

        </div>
    </div>

    {{-- FORMULARIO DE RESERVA --}}
    <section class="reserva-box">
        <form action="{{ route('bookings.store', $place->id) }}" method="POST" id="reservaForm">
            @csrf
            <input type="hidden" name="place_id" value="{{ $place->id }}">
            <input type="hidden" name="start_date" id="inputStartDate">
            <input type="hidden" name="end_date" id="inputEndDate">
            <input type="hidden" name="total_price" id="inputTotalPrice">
            <input type="hidden" name="currency" value="{{ $place->currency ?? 'USD' }}">
            <input type="number" name="guests" id="inputGuests" min="1" value="1" hidden>

            <div class="fechas">
                <div class="fcol">
                    <p class="label">Desde</p>
                    <h3 class="fecha-valor" id="fechaInicio">---</h3>
                </div>
                <div class="swap-icon">⇄</div>
                <div class="fcol">
                    <p class="label">Hasta</p>
                    <h3 class="fecha-valor" id="fechaFin">---</h3>
                </div>
            </div>

            <div class="total">
                <div class="precio-line">
                    <small>{{ $place->entrance_fee ?? 0 }} {{ $place->currency ?? 'USD' }} x Noche</small>
                    <small id="nochesText">--- Noche(s) × {{ $place->entrance_fee ?? 0 }} {{ $place->currency ?? 'USD' }}</small>
                </div>
            </div>

            <button type="submit" class="btn-total" id="btnTotal" disabled>Reservar</button>
        </form>
    </section>

</div>

{{-- SCRIPT CALENDARIO + TOTAL --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const precioNoche = {{ $place->entrance_fee ?? 0 }};
    let displayedMonth = new Date().getMonth();
    let displayedYear = new Date().getFullYear();
    const monthNames = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    const monthTitle = document.getElementById('monthTitle');
    const calendarGrid = document.getElementById('calendarGrid');
    const fechaInicioEl = document.getElementById('fechaInicio');
    const fechaFinEl = document.getElementById('fechaFin');
    const nochesText = document.getElementById('nochesText');
    const btnTotal = document.getElementById('btnTotal');
    const inputStart = document.getElementById('inputStartDate');
    const inputEnd = document.getElementById('inputEndDate');
    const inputTotal = document.getElementById('inputTotalPrice');

    let fechaInicio = null;
    let fechaFin = null;

    function dateToYMD(d) {
        const pad = n => String(n).padStart(2,'0');
        return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
    }

    function isAvailable(dateStr) {
        const h = Array.from(dateStr).reduce((a,b)=>a+b.charCodeAt(0),0);
        return (h % 10) > 1;
    }

    function renderCalendar() {
        monthTitle.textContent = monthNames[displayedMonth] + ' ' + displayedYear;
        calendarGrid.innerHTML = '';
        const first = new Date(displayedYear, displayedMonth, 1);
        const offset = (first.getDay()+6)%7;
        const daysInMonth = new Date(displayedYear, displayedMonth+1,0).getDate();

        for(let i=0;i<offset;i++){
            const div = document.createElement('div');
            div.classList.add('day','placeholder');
            calendarGrid.appendChild(div);
        }

        for(let d=1; d<=daysInMonth; d++){
            const div = document.createElement('div');
            div.classList.add('day');
            div.textContent = d;
            const dateStr = dateToYMD(new Date(displayedYear,displayedMonth,d));
            if(!isAvailable(dateStr)) div.classList.add('ocupado');
            div.addEventListener('click', ()=>onDayClick(dateStr));
            calendarGrid.appendChild(div);
        }
        updateSelected();
        updateTotal();
    }

    function onDayClick(dateStr){
        if(!isAvailable(dateStr)) return;
        if(!fechaInicio || (fechaInicio && fechaFin)){
            fechaInicio = dateStr;
            fechaFin = null;
        } else {
            if(new Date(dateStr) <= new Date(fechaInicio)){
                fechaInicio = dateStr;
                fechaFin = null;
            } else {
                fechaFin = dateStr;
            }
        }
        updateSelected();
        updateTotal();
    }

    function updateSelected(){
        document.querySelectorAll('.calendario .day').forEach(div=>{
            div.classList.remove('seleccionado','start-day','end-day');
            const day = parseInt(div.textContent);
            if(isNaN(day)) return;
            const dateStr = dateToYMD(new Date(displayedYear,displayedMonth,day));
            if(fechaInicio && dateStr===fechaInicio) div.classList.add('start-day','seleccionado');
            if(fechaFin && dateStr===fechaFin) div.classList.add('end-day','seleccionado');
            if(fechaInicio && fechaFin && dateStr>fechaInicio && dateStr<fechaFin) div.classList.add('seleccionado');
        });

        fechaInicioEl.textContent = fechaInicio ?? '---';
        fechaFinEl.textContent = fechaFin ?? '---';
        inputStart.value = fechaInicio ?? '';
        inputEnd.value = fechaFin ?? '';
    }

    function updateTotal(){
        if(fechaInicio && fechaFin){
            const diff = (new Date(fechaFin) - new Date(fechaInicio))/(1000*60*60*24);
            const total = diff * precioNoche;
            nochesText.textContent = `${diff} Noche(s) × ${precioNoche} {{ $place->currency ?? 'USD' }}`;
            btnTotal.textContent = 'Reservar ' + total + ' {{ $place->currency ?? 'USD' }}';
            inputTotal.value = total;
            btnTotal.disabled = false;
        } else {
            nochesText.textContent = `--- Noche(s) × ${precioNoche} {{ $place->currency ?? 'USD' }}`;
            btnTotal.textContent = 'Reservar';
            inputTotal.value = '';
            btnTotal.disabled = true;
        }
    }

    document.getElementById('prevMonth').addEventListener('click',()=>{
        displayedMonth = displayedMonth === 0 ? 11 : displayedMonth-1;
        displayedYear = displayedMonth === 11 ? displayedYear-1 : displayedYear;
        renderCalendar();
    });
    document.getElementById('nextMonth').addEventListener('click',()=>{
        displayedMonth = displayedMonth === 11 ? 0 : displayedMonth+1;
        displayedYear = displayedMonth === 0 ? displayedYear+1 : displayedYear;
        renderCalendar();
    });

    renderCalendar();
});
</script>
@endsection
