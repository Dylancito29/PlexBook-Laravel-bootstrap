@extends('layouts.app')

{{-- 
    🎓 DASHBOARD VIEW
    This is the "Control Center" or Home Page for the application.
    It displays high-level statistics and quick links for the user.
--}}

@section('content')

{{-- Custom CSS for this specific view (Hover effects) --}}
<style>
  .hover-card {
      transition: all 0.3s ease;
      border: none;
  }
  
  .hover-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 1rem 3rem rgba(0,0,0,.15)!important;
      cursor: pointer;
  }
  
  .card-link {
      text-decoration: none;
      color: inherit;
      display: block;
  }
  
  .stat-card {
      border-left: 4px solid #0d6efd;
      background: white;
      transition: 0.3s;
  }
  .stat-card:hover {
      background: #f8f9fa;
  }
</style>

<div class="row mb-5 align-items-center">
    <div class="col-md-8">
        {{-- Greets the user dynamically by name, or 'Guest' if not logged in --}}
        <h1 class="fw-bold text-dark">Welcome back, {{ auth()->user() ? auth()->user()->name : 'Guest' }}!</h1>
        <p class="text-muted fs-5">Here is what's happening with your library today.</p>
    </div>
    <div class="col-md-4 text-md-end">
        {{-- Display current date using Carbon library --}}
        <span class="text-muted">{{ now()->format('l, d F Y') }}</span>
    </div>
</div>

<!-- Stats Row: Only visible to Logged In Users -->
@auth
<div class="row g-4 mb-5">
    
    {{-- Card 1: Active Loans Counter --}}
    <div class="col-md-4">
        <div class="card p-3 shadow-sm stat-card h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-muted small fw-bold">Active Loans</h6>
                    <h2 class="mb-0 fw-bold text-primary">{{ $activeLoansCount ?? 0 }}</h2>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                    <i class="bi bi-journal-bookmark fs-4"></i>
                </div>
            </div>
            <a href="{{ route('books.myLoans') }}" class="small text-decoration-none mt-3 d-block">View details <i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
    
    {{-- Card 2: Due Soon (Warning) --}}
    <div class="col-md-4">
        <div class="card p-3 shadow-sm stat-card h-100" style="border-left-color: #ffc107;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-muted small fw-bold">Due Soon</h6>
                    <h2 class="mb-0 fw-bold text-warning">{{ $pendingReturnsCount ?? 0 }}</h2>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
            </div>
             <a href="{{ route('books.myLoans') }}" class="small text-decoration-none mt-3 d-block text-warning">Check status <i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
    
    {{-- Card 3: Total Library Inventory --}}
    <div class="col-md-4">
        <div class="card p-3 shadow-sm stat-card h-100" style="border-left-color: #198754;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-muted small fw-bold">Library Catalog</h6>
                    <h2 class="mb-0 fw-bold text-success">{{ $totalBooks ?? 0 }}</h2>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                    <i class="bi bi-collection fs-4"></i>
                </div>
            </div>
             <a href="{{ route('books.catalog') }}" class="small text-decoration-none mt-3 d-block text-success">Browse all <i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
</div>
@endauth

<!-- Quick Actions -->
<h4 class="mb-4 fw-bold"><i class="bi bi-grid-fill me-2 text-secondary"></i>Quick Actions</h4>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">

  <div class="col">
    <a href="{{ route('books.catalog') }}" class="card-link h-100">
      <div class="card shadow-sm h-100 hover-card">
          <div class="position-relative" style="height: 160px; overflow: hidden;">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxO1qtTOHE3Vhlsoz4BrhL-zqU25Pu1qErlg&s" class="card-img-top h-100" style="object-fit: cover;">
              <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center">
                  <i class="bi bi-search text-white display-4"></i>
              </div>
          </div>
        <div class="card-body text-center">
          <h5 class="card-title fw-bold">Browse Catalog</h5>
          <p class="card-text small text-muted">Find your next favorite book.</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col">
    <a href="{{ route('books.myLoans') }}" class="card-link h-100">
      <div class="card shadow-sm h-100 hover-card">
          <div class="position-relative" style="height: 160px; overflow: hidden;">
              <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="card-img-top h-100" style="object-fit: cover;">
              <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center">
                  <i class="bi bi-journal-check text-white display-4"></i>
              </div>
          </div>
        <div class="card-body text-center">
          <h5 class="card-title fw-bold">My Loans</h5>
          <p class="card-text small text-muted">Check history and returns.</p>
        </div>
      </div>
    </a>
  </div>

  @if(auth()->check() && auth()->user()->isAdmin())
  <div class="col">
    <a href="{{ route('books.add') }}" class="card-link h-100">
      <div class="card shadow-sm h-100 hover-card">
          <div class="position-relative" style="height: 160px; overflow: hidden;">
              <img src="https://images.unsplash.com/photo-1550399105-c4db5fb85c18?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="card-img-top h-100" style="object-fit: cover;">
              <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center">
                   <i class="bi bi-plus-circle text-white display-4"></i>
              </div>
          </div>
        <div class="card-body text-center">
          <h5 class="card-title fw-bold">Add Book</h5>
          <p class="card-text small text-muted">Register a new title (Admin).</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col">
    <a href="{{ route('books.delete') }}" class="card-link h-100">
      <div class="card shadow-sm h-100 hover-card">
           <div class="position-relative" style="height: 160px; overflow: hidden;">
              <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="card-img-top h-100" style="object-fit: cover;">
               <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center">
                   <i class="bi bi-trash text-white display-4"></i>
               </div>
          </div>
        <div class="card-body text-center">
          <h5 class="card-title fw-bold">Remove Book</h5>
          <p class="card-text small text-muted">Delete old titles (Admin).</p>
        </div>
      </div>
    </a>
  </div>
  @endif
  
</div>

<!-- Recommended Section -->
@if(isset($featuredBooks) && count($featuredBooks) > 0)
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0"><i class="bi bi-stars me-2 text-warning"></i>Recommended for You</h4>
    <a href="{{ route('books.catalog') }}" class="btn btn-outline-primary btn-sm">View All</a>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($featuredBooks as $book)
    <div class="col">
        <div class="card h-100 border-0 shadow-sm">
            <div class="row g-0 h-100">
                <div class="col-4">
                     <img src="{{ $book->cover_url }}" class="img-fluid rounded-start h-100" style="object-fit: cover; width: 100%;" alt="{{ $book->title }}">
                </div>
                <div class="col-8">
                    <div class="card-body d-flex flex-column h-100 justify-content-center">
                        <h6 class="card-title fw-bold text-truncate" title="{{ $book->title }}">{{ $book->title }}</h6>
                        <small class="text-muted mb-2">{{ $book->author ? $book->author->name : 'Unknown' }}</small>
                        <a href="{{ route('books.catalog', ['query' => $book->title]) }}" class="btn btn-sm btn-primary mt-auto align-self-start">View Book</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
