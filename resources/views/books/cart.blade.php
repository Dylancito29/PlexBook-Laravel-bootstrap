@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <!-- Cart Items Column -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-primary bg-opacity-10 py-3 border-bottom-0">
                    <h4 class="mb-0 fw-bold text-primary"><i class="bi bi-book-half me-2"></i>Lista de Préstamos</h4>
                </div>
                
                <div class="card-body p-0">
                    @if(Session::has('cart') && count(Session::get('cart')) > 0)
                        <div class="list-group list-group-flush">
                            @foreach(Session::get('cart') as $id => $details)
                                <div class="list-group-item p-4 d-flex align-items-center gap-4 hover-bg-light transition-all">
                                    <!-- Book Cover -->
                                    <div class="position-relative shadow-sm rounded overflow-hidden flex-shrink-0" style="width: 80px; height: 110px;">
                                        <img src="{{ $details['cover'] }}" class="w-100 h-100 object-fit-cover" alt="{{ $details['title'] }}">
                                    </div>

                                    <!-- Book Info -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="fw-bold mb-0 text-dark">{{ $details['title'] }}</h5>
                                            <a href="{{ route('books.removeFromCart', $id) }}" class="btn btn-outline-danger btn-sm border-0 rounded-circle p-2" title="Eliminar del préstamo">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                        
                                        <p class="text-muted mb-2 small"><i class="bi bi-person me-1"></i> {{ $details['author'] }}</p>
                                        
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-secondary border">
                                                <i class="bi bi-tag me-1"></i> {{ $details['category'] ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-journal-x text-muted opacity-25" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-secondary fw-bold">Tu lista de préstamos está vacía</h5>
                            <p class="text-muted small mb-4">¡Agrega libros para comenzar tu aventura!</p>
                            <a href="{{ route('books.catalog') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-search me-2"></i>Explorar Catálogo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Summary Column -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top: 2rem; z-index: 10;">
                <div class="card-header bg-light py-3 border-bottom-0">
                    <h5 class="mb-0 fw-bold text-dark">Resumen del Préstamo</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Total Libros</span>
                        <span class="fw-bold fs-5 text-primary">{{ Session::has('cart') ? count(Session::get('cart')) : 0 }} / 5</span>
                    </div>

                    @if(Session::has('cart') && count(Session::get('cart')) > 0)
                        <div class="alert alert-warning border-0 bg-warning bg-opacity-10 text-warning-emphasis small mb-4">
                            <i class="bi bi-info-circle-fill me-2"></i>Los libros deben ser devueltos en un plazo máximo de 15 días.
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <form action="{{ route('books.processLoan') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                                <i class="bi bi-check-lg me-2"></i>Confirmar Préstamo
                            </button>
                        </form>
                    @else
                         <button class="btn btn-secondary w-100 py-3 rounded-pill shadow-sm fw-bold" disabled>
                            Confirmar Préstamo
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
