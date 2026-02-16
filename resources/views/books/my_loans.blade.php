@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary"><i class="bi bi-journal-bookmark me-2"></i>Mis Préstamos</h2>
            <p class="text-muted mb-0">Historial de libros prestados</p>
        </div>
        <a href="{{ route('books.catalog') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Prestar Nuevo Libro
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">Libro</th>
                            <th class="py-3">Fecha de Préstamo</th>
                            <th class="py-3">Fecha de Devolución</th>
                            <th class="py-3">Estado</th>
                            <th class="pe-4 py-3 text-end">Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                            <tr>
                                <!-- Libro -->
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        @if($loan->book)
                                            <img src="{{ $loan->book->cover_url }}" class="rounded shadow-sm" style="width: 40px; height: 60px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $loan->book->title }}</div>
                                                <div class="small text-muted">{{ optional($loan->book->author)->name }}</div>
                                            </div>
                                        @else
                                            <span class="text-danger fst-italic">Libro no disponible</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Fechas -->
                                <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M, Y') }}</td>
                                <td>
                                    @php
                                        $returnDate = \Carbon\Carbon::parse($loan->return_date);
                                        $isOverdue = $returnDate->isPast() && $loan->status == 'active';
                                        $daysLeft = now()->diffInDays($returnDate, false);
                                    @endphp
                                    
                                    @if($loan->status == 'active')
                                        <span class="{{ $isOverdue ? 'text-danger fw-bold' : ($daysLeft <= 3 ? 'text-warning fw-bold' : 'text-dark') }}">
                                            {{ $returnDate->format('d M, Y') }}
                                        </span>
                                        
                                        @if($isOverdue)
                                            <div class="small text-danger"><i class="bi bi-exclamation-triangle me-1"></i> Atrasado</div>
                                        @elseif($daysLeft >= 0 && $daysLeft <= 3)
                                             <div class="small text-warning">¡Quedan {{ round($daysLeft) }} días!</div>
                                        @endif
                                    @else
                                        <span class="text-muted">{{ $returnDate->format('d M, Y') }}</span>
                                    @endif
                                </td>

                                <!-- Estado -->
                                <td>
                                    @if($loan->status == 'active')
                                        @if($isOverdue)
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3">Atrasado</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">Activo</span>
                                        @endif
                                    @elseif($loan->status == 'returned')
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary rounded-pill px-3">Devuelto</span>
                                    @else
                                        <span class="badge bg-light text-dark border rounded-pill px-3">{{ $loan->status }}</span>
                                    @endif
                                </td>
                                
                                <td class="pe-4 text-end">
                                     @if($loan->status == 'active')
                                        <small class="text-muted">Devolver en biblioteca</small>
                                     @else
                                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                     @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="bi bi-journal-album text-muted opacity-25" style="font-size: 3rem;"></i>
                                    </div>
                                    <h5 class="text-muted">Aún no has prestado ningún libro.</h5>
                                    <a href="{{ route('books.catalog') }}" class="btn btn-outline-primary mt-2">Ir al Catálogo</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
             {{ $loans->links() }}
        </div>
    </div>
</div>
@endsection
