


<div class="carousel-container">
    <div class="carousel-track">
        {{-- Primera vuelta --}}
        @foreach ($carouselBooks as $book)
            <div class="carousel-card" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalShowBookCarousel{{ $book->id }}">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $book->cover_url }}" class="card-img-top hover-card imagen" alt="Book Cover" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="card-title text-truncate" title="{{ $book->title }}">{{ $book->title }}</h6>
                        <p class="card-text small text-muted mb-1">{{ optional($book->author)->name }}</p>
                        <span class="badge bg-light text-dark border">{{ $book->category->name }}</span>
                    </div>  
                </div>
            </div>  
        @endforeach

        {{-- Segunda vuelta (Duplicada para el efecto infinito) --}}
        @foreach ($carouselBooks as $book)
            <div class="carousel-card" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalShowBookCarousel{{ $book->id }}">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $book->cover_url }}" class="card-img-top hover-card imagen" alt="Book Cover" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="card-title text-truncate" title="{{ $book->title }}">{{ $book->title }}</h6>
                        <p class="card-text small text-muted mb-1">{{ optional($book->author)->name }}</p>
                        <span class="badge bg-light text-dark border">{{ $book->category->name }}</span>
                    </div>  
                </div>
            </div>  
        @endforeach
    </div>
</div>

{{-- Modales para los libros del carrusel --}}
@foreach ($carouselBooks as $book)
    @include('books.showBook', ['book' => $book, 'modalId' => 'modalShowBookCarousel'.$book->id])
@endforeach

    
    