@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4 border-0">
                    <h3 class="fw-bold mb-0">
                         <i class="bi bi-person-plus-fill me-2"></i> Únete a PlexBook
                    </h3>
                    <p class="mb-0 opacity-75">Crea tu cuenta gratis</p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold text-muted small text-uppercase">Nombre Completo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                <input id="name" type="text" class="form-control border-start-0 bg-light ps-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Jhon Doe">
                            </div>
                            @error('name')
                                <span class="text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-muted small text-uppercase">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" class="form-control border-start-0 bg-light ps-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nombre@ejemplo.com">
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
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock-fill"></i></span>
                                <input id="password" type="password" class="form-control border-start-0 bg-light ps-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold text-muted small text-uppercase">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-check2-circle"></i></span>
                                <input id="password-confirm" type="password" class="form-control border-start-0 bg-light ps-0" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm font-weight-bold rounded-pill">
                                Registrarse <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light text-center py-3 border-0">
                    <p class="mb-0 text-muted small">
                        ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="fw-bold text-success text-decoration-none">Inicia Sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
