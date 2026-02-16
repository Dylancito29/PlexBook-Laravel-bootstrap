@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4 border-0">
                    <h3 class="fw-bold mb-0">
                        <i class="bi bi-journal-bookmark-fill me-2"></i> PlexBook
                    </h3>
                    <p class="mb-0 opacity-75">Bienvenido de nuevo</p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-muted small text-uppercase">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" class="form-control border-start-0 bg-light ps-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nombre@ejemplo.com">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-muted small text-uppercase">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" class="form-control border-start-0 bg-light ps-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********">
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="remember">
                                    Recuérdame
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm font-weight-bold rounded-pill">
                                Iniciar Sesión <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light text-center py-3 border-0">
                    <p class="mb-0 text-muted small">
                        ¿No tienes una cuenta? <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Regístrate aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
