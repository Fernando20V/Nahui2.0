{{-- resources/views/layouts/header.blade.php --}}
<header class="header">
    <!-- Logo -->
    <section class="section_header">
        <div class="logo">
            <img src="{{ asset('imagenes/Recurso 3.png') }}" alt="Logo" class="img_logo" />
        </div>

        <!-- Menú de navegación -->
        @php
            $currentRoute = Route::currentRouteName();
        @endphp
        <nav class="nav">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ $currentRoute === 'home' ? 'active' : '' }}">Inicio</a>
                </li>
                <li>
                    <a href="#" class="{{ $currentRoute === 'place' ? 'active' : '' }}">Mis Lugares</a>
                </li>
                <li>
                    <a href="#" class="{{ $currentRoute === 'transporte' ? 'active' : '' }}">Transporte</a>
                </li>
                <li>
                    <a href="#" class="{{ $currentRoute === 'mapa' ? 'active' : '' }}">Mapa Interactivo</a>
                </li>

                {{-- Menú dinámico según rol --}}
                @auth
                    @if(auth()->user()->role === 'host')
                        <li>
                            <a href="places" class="{{ $currentRoute === 'places.index' ? 'active' : '' }}">Mi Hospedaje</a>
                        </li>
                    @elseif(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="{{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}">Panel Admin</a>
                        </li>
                    @elseif(auth()->user()->role === 'cliente')
                        <li>
                            <a href="{{ route('reservas.index') }}" class="{{ $currentRoute === 'reservas.index' ? 'active' : '' }}">Mis Reservas</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
    </section>

    <!-- Íconos a la derecha -->
    <div class="icons relative">
        <i class="fa-solid fa-bell mr-4"></i>

@auth
<div class="user-dropdown">
    <!-- Icono de usuario -->
    <button id="user-dropdown-button" class="user-icon">
        <i class="fa-solid fa-user-circle"></i>
    </button>

    <!-- Dropdown -->
    <div id="dropdown-menu" class="dropdown-menu hidden">
        <div class="user-name">
            {{ auth()->user()->name }}
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">
                Cerrar sesión
            </button>
        </form>
    </div>
</div>

<script>
    const dropdownButton = document.getElementById('user-dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
@else
<a href="{{ route('login') }}" class="login-link">Iniciar sesión</a>
@endauth

    </div>

    <!-- Botón hamburguesa (solo en móvil) -->
    <button class="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </button>
</header>

