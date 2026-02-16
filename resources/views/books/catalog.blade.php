@extends('layouts.app')

{{-- 
    📚 CATALOG VIEW (Public)
    This is the main "Browsing" page exposed to all users (and visitors).
    It displays the list of books with search functionality.
    
    NOTE: Admins see 'admin_catalog.blade.php' instead, which includes Edit/Delete buttons.
--}}

@section('content')

<div class="">
  <h1>Thousands of titles to read</h1>
</div>

{{-- Include the automated Carousel component for "New Arrivals" --}}
@include('books.carousel')

<div class="card p-3" >
  <div class="row">
    <div class="col-6" >
      <h1>Book list</h1>
    </div>
    <div class="d-flex col-6 mb-3 gap-2 align-items-center justify-content-end" >
      
    {{-- 
        SEARCH FORM
        Submits a GET request with 'query' parameter to filter results.
    --}}
    <form action="{{ route('books.catalog') }}" method="GET">
        <div class="input-group w-auto">
            <input type="text" name="query" class="form-control" placeholder="Search Book" aria-label="Input group example" aria-describedby="btnGroupAddon2">
            <button type="submit" class="input-group-text btn btn-outline-primary" id="btnGroupAddon2">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
        </div>


    </div>

  </div>
  
  
  <table class="table table-striped table-hover">
    <thead>
      <tr align="center" >
        <th scope="col">ID</th>
        <th scope="col">Cover</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        <th scope="col" >Stock</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      {{-- Loop through the Paginated Collection of Books --}}
      @foreach($books as $book)
      <tr style="vertical-align: middle; justify-items: center; " align="center">
        <th scope="row">{{ $book->id }}</th>
  
        
        <td><img src="{{ $book->cover_url }}" alt="Book Cover" style="width: 50px; height: auto;"></td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->category->name }}</td>
        {{-- Use 'optional()' helper to prevent errors if Author was deleted --}}
        <td>{{ optional($book->author)->name }}</td>
        <td>
           {{-- Stock Badge: Visual indicator for availability --}}
           @if($book->stock > 0)
              <span class="badge bg-success">{{ $book->stock }} available</span>
           @else
              <span class="badge bg-danger">Out of Stock</span>
           @endif
        </td>
  
        <td>
          <div class="d-flex justify-content-center gap-2">
            {{-- View Details Button (Triggers Modal) --}}
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalShowBook{{ $book->id }}" title="See Details">
              <i class="bi bi-eye"></i> Details
            </button>

            <!-- Add to Cart (Only for Logged Users AND if Stock > 0) -->
            @auth
               @if($book->stock > 0)
                <a href="{{ route('books.addToCart', $book->id) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-cart-plus"></i> Add
                </a>
               @else
                 <button class="btn btn-secondary btn-sm" disabled>
                    <i class="bi bi-slash-circle"></i> No Stock
                 </button>
               @endif
            @endauth

            {{-- Include the unique Detail Modal for this book --}}
            @include('books.showBook', ['book' => $book])
          </div>
        </td>
      </tr>
      @endforeach
  </tbody>
  </table>
  
  {{-- Pagination Links (1, 2, Next...) --}}
  <div class="d-flex justify-content-center">
    {{ $books->links() }}
  </div>
  
  {{-- Flash Messages (Success/Error feedback) --}}
  @if (session('success'))
  <div class="alert alert-success" role="alert" >
  {{ session('success') }}
  </div>
  @elseif (session('error'))
      <div class="alert alert-danger" role="alert" >
      {{ session('error') }}
      </div>  
  @endif

</div>  

@endsection