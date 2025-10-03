@extends('layouts.app')

@section('content')
<div class="login-container">
    <!-- Imagen lateral -->
    <div class="background">
        <img src="{{ asset('imagenes/login.png') }}" alt="Login" class="img_login" />
    </div>

    <div class="login-box">
        <h2>Inicio de sesión</h2>

        <!-- Mensajes de estado -->
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario de login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Usuario/Email -->
            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    placeholder="Correo"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                />
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group password">
                <input
                    type="password"
                    name="password"
                    placeholder="Contraseña"
                    required
                    autocomplete="current-password"
                />
                <i class="fa fa-eye eye-icon"></i>
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember me -->
            <div class="mt-2 flex items-center gap-2">
                <input id="remember" type="checkbox" name="remember" class="rounded border-gray-300" />
                <label for="remember" class="text-sm text-gray-700">
                    Mantener sesión
                </label>
            </div>

            <!-- Botones -->
            <div class="buttons">
                <button type="submit" class="btn primary">
                    Iniciar sesión
                </button>
                <a href="{{ route('register') }}" class="btn secondary text-center">
                    Crear cuenta nueva
                </a>
            </div>

            <!-- Forgot password -->
            @if (Route::has('password.request'))
                <a class="forgot" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </form>
    </div>
</div>
@endsection
