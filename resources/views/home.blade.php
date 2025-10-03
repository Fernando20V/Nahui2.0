@extends('layouts.app') {{-- Usa tu layout principal donde está el header --}}

@section('content')
<div class="places-page">
    <!-- Buscador -->
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Buscador..." />
        <i class="fas fa-search search-icon"></i>
    </div>

    <!-- Categorías -->
    @foreach($categorias as $categoria)
        <div class="category">
            <h2>{{ $categoria['nombre'] }} ›</h2>
            <div class="grid">
                @foreach($categoria['lugares'] as $lugar)
                    <div class="card" onclick="goToPlace('{{ $lugar['titulo'] }}')">
                        <img src="{{ $lugar['imagen'] }}" alt="{{ $lugar['titulo'] }}">
                        <div class="card-body">
                            <h3>{{ $lugar['titulo'] }}</h3>
                            <p>{{ $lugar['descripcion'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.card');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        cards.forEach(card => {
            const title = card.querySelector('h3').innerText.toLowerCase();
            card.style.display = title.includes(query) ? 'block' : 'none';
        });
    });

    function goToPlace(title) {
        alert('Ir al lugar: ' + title);
        // Aquí puedes redirigir a la ruta de detalle usando window.location.href
    }
</script>
@endsection
