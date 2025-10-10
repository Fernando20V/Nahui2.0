@extends('layouts.app')

@section('content')
<div class="register-container">
    <!-- Imagen lateral -->
    <div class="background">
        <img src="{{ asset('imagenes/login.png') }}" alt="Registro" class="img_register" />
    </div>

    <!-- Formulario -->
    <div class="register-box">
        <h2>Crear cuenta nueva</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div class="form-group">
                <input
                    type="text"
                    name="name"
                    placeholder="Nombre completo"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                />
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    placeholder="Correo electrónico"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                />
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group password">
                <input
                    type="password"
                    name="password"
                    placeholder="Contraseña"
                    required
                    autocomplete="new-password"
                />
                <i class="fa fa-eye eye-icon"></i>
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div class="form-group password">
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirmar contraseña"
                    required
                    autocomplete="new-password"
                />
                <i class="fa fa-eye eye-icon"></i>
                @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="buttons">
                <button type="submit" class="btn primary">
                    Registrarse
                </button>
                <a href="{{ route('login') }}" class="btn secondary">
                    ¿Ya tienes una cuenta? Inicia sesión
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
