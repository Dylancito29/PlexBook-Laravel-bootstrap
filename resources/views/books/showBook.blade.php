

<!-- Modal -->
<div class="modal fade" id="{{ $modalId ?? 'modalShowBook'.$book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-bottom-0">
        <h1 class="modal-title fs-4 fw-bold text-primary" id="exampleModalLabel">Book Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        
        <div class="row g-4">
            <!-- Book Cover Column -->
            <div class="col-md-5 d-flex justify-content-center align-items-start">
                <div class="shadow rounded overflow-hidden" style="width: 100%; max-width: 300px;">
                    <img src="{{ $book->cover_url }}" class="img-fluid w-100" alt="{{ $book->title }}" style="object-fit: cover; aspect-ratio: 2/3;">
                </div>
            </div>

            <!-- Details Column -->
            <div class="col-md-7 d-flex flex-column">
                <div>
                    <h2 class="fw-bold mb-1">{{ $book->title }}</h2>
                    <p class="text-muted fs-5 mb-3">{{ optional($book->author)->name }}</p>

                    <div class="d-flex gap-2 mb-4">
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2 rounded-pill">
                            <i class="bi bi-tag-fill me-1"></i> {{ $book->category->name }}
                        </span>
                        <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $book->stock > 0 ? 'text-success border-success' : 'text-danger border-danger' }} border px-3 py-2 rounded-pill">
                            <i class="bi bi-box-seam me-1"></i> Stock: {{ $book->stock }}
                        </span>
                    </div>
                    
                    @if($book->description)
                        <div class="mb-4">
                            <h6 class="fw-bold text-secondary text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Description</h6>
                            <p class="text-secondary" style="line-height: 1.6; max-height: 150px; overflow-y: auto; padding-right: 10px;">
                                {{ $book->description }}
                            </p>
                        </div>
                    @else
                        <div class="mb-4 text-muted fst-italic">
                            No description available.
                        </div>
                    @endif
                </div>

                <div class="mt-auto">
                    <!-- Customer Actions -->
                    <!-- Updated for Lending Logic: Direct 'Borrow' button, no quantity selector needed for loans -->
                    <div class="d-grid gap-2 mb-3">
                        <a href="{{ route('books.addToCart', $book->id) }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="bi bi-journal-plus me-2"></i> Prestar Libro
                        </a>
                    </div>

                    <!-- Admin Actions (Divider) -->
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <hr class="my-3 text-muted">
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-warning w-50" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $book->id }}">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </button>
                        <button type="button" class="btn btn-outline-danger w-50">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>
</div>

@if(auth()->check() && auth()->user()->isAdmin())
    @include('books.updateModal', ['book' => $book])
@endif