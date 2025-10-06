{{-- resources/views/layouts/header.blade.php --}}
<div class="con_header">

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
        <nav class="nav" id="navMenu" aria-hidden="true">
            {{-- Close button (se muestra en móvil) --}}
            <button id="navClose" class="nav-close" aria-label="Cerrar menú" type="button" style="display:none;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ $currentRoute === 'home' ? 'active' : '' }}">Inicio</a>
                </li>
                <li>
                    <a href="catalogo" class="{{ $currentRoute === 'place' ? 'active' : '' }}">Lugares</a>
                </li>
                <li>
                    <a href="#" class="{{ $currentRoute === 'transporte' ? 'active' : '' }}">Transporte</a>
                </li>
                <li>
                    <a href="{{ url('mapa') }}" class="{{ $currentRoute === 'mapa' ? 'active' : '' }}">Mapa Interactivo</a>
                </li>

                {{-- Menú dinámico según rol --}}
                @auth
                    @if(auth()->user()->role === 'host')
                        <li>
                            <a href="{{ url('places') }}" class="{{ $currentRoute === 'places.index' ? 'active' : '' }}">Mi Hospedaje</a>
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
        @auth
        <div class="user-dropdown">
            <!-- Icono de usuario -->
            <button id="user-dropdown-button" class="user-icon" type="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-user-circle"></i>
            </button>

            <!-- Dropdown -->
            <div id="dropdown-menu" class="dropdown-menu hidden" role="menu" aria-hidden="true">
                <div class="user-name">
                    {{ auth()->user()->name }}
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button" role="menuitem">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
        @else
        <a href="{{ route('login') }}" class="login-link">Iniciar sesión</a>
        @endauth
    </div>

    <!-- Botón hamburguesa (solo en móvil) -->
    <button class="menu-toggle" id="menuToggle" aria-label="Abrir menú" type="button">
        <i class="fa-solid fa-bars"></i>
    </button>

</header>
</div>

{{-- SCRIPT: controla menú móvil y dropdown de usuario (robusto y protegido) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Elementos
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');
    const navClose = document.getElementById('navClose');
    const body = document.body;

    // user dropdown elementos (pueden no existir si no hay auth)
    const dropdownButton = document.getElementById('user-dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    // Helpers
    function openMenu() {
        if (!navMenu) return;
        navMenu.classList.add('open');
        navMenu.setAttribute('aria-hidden', 'false');
        if (menuToggle) menuToggle.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        body.classList.add('no-scroll');
    }
    function closeMenu() {
        if (!navMenu) return;
        navMenu.classList.remove('open');
        navMenu.setAttribute('aria-hidden', 'true');
        if (menuToggle) menuToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
        body.classList.remove('no-scroll');
    }

    // Solo si existen los nodos
    if (menuToggle && navMenu) {
        // Mostrar el botón de cerrar dentro del nav en mobile (estilo manejado por CSS)
        if (navClose) navClose.style.display = 'block';

        // Toggle con prevención de propagación para evitar cierres inmediatos
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            if (navMenu.classList.contains('open')) closeMenu();
            else openMenu();
        });

        // Close button dentro del nav
        if (navClose) {
            navClose.addEventListener('click', function (e) {
                e.stopPropagation();
                closeMenu();
            });
        }

        // Evitar que clicks dentro del nav cierren el menu (delegación)
        navMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        // Click fuera -> cerrar
        document.addEventListener('click', function (e) {
            if (navMenu.classList.contains('open') && !navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                closeMenu();
            }
        });

        // Cerrar con Esc
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && navMenu.classList.contains('open')) {
                closeMenu();
            }
        });

        // Si se hace click en un enlace del menu (mobile), cerrarlo (para navegacion)
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) closeMenu();
            });
        });
    }

    // Dropdown de usuario (solo si existe)
    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        // Cerrar dropdown si clic en cualquier parte fuera de él
        document.addEventListener('click', function (e) {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Evitar que click dentro del menu lo cierre via propagacion
        dropdownMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    }
});
</script>
