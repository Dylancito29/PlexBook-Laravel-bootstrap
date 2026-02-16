@extends('layouts.app')
@section('content')

<div class="">
  <h1 class="text-danger"><i class="bi bi-shield-lock"></i> Administration Panel</h1>
  <p>Manage books, stock and catalog details.</p>
</div>

{{-- Admin doesn't necessarily need the carousel, but we keep it or remove it depending on preference. --}}

<div class="card p-3 shadow-sm" >
  <div class="row align-items-center">
    <div class="col-md-6" >
      <h3><i class="bi bi-collection"></i> Full Catalog Manager</h3>
    </div>
    <div class="d-flex col-md-6 mb-3 gap-2 align-items-center justify-content-end" >
      
    <form action="{{ route('books.catalog') }}" method="GET">
        <div class="input-group w-auto">
            <input type="text" name="query" class="form-control" placeholder="Search title..." aria-label="Search">
            <button type="submit" class="input-group-text btn btn-outline-primary">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
          {{-- Add Book Button is OK here for Admins --}}
          <a href="{{ route('books.add') }}" class="btn btn-success">
             <i class="bi bi-plus-circle"></i> Add New Book
          </a>
    </div>

  </div>
  
  
  <table class="table table-striped table-hover align-middle mt-3">
    <thead class="table-dark">
      <tr align="center" >
        <th scope="col">ID</th>
        <th scope="col">Cover</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        <th scope="col">Stock</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $book)
      <tr align="center">
        <th scope="row">{{ $book->id }}</th>
        <td><img src="{{ $book->cover_url }}" alt="Cover" class="rounded border" style="width: 40px; height: 60px; object-fit: cover;"></td>
        <td class="fw-bold">{{ $book->title }}</td>
        <td>{{ $book->category->name }}</td>
        <td>{{ optional($book->author)->name }}</td>
        <td>
             <span class="badge {{ $book->stock < 5 ? 'bg-danger' : 'bg-success' }}">{{ $book->stock }}</span>
        </td>
  
        <td>
          <div class="btn-group" role="group">
             {{-- View --}}
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalShowBook{{ $book->id }}" title="View Details">
              <i class="bi bi-eye"></i>
            </button>

            {{-- Edit --}}
            <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $book->id }}" title="Edit">
                <i class="bi bi-pencil"></i>
            </button>

            {{-- Delete --}}
             <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $book->id }}" title="Delete">
                <i class="bi bi-trash"></i>
            </button>
          </div>
            
            {{-- Include Modals locally for this view --}}
            @include('books.showBook', ['book' => $book])
            @include('books.updateModal', ['book' => $book])
            
            <!-- Delete Confirmation Modal Inline -->
            <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Delete Book</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete <strong>{{ $book->title }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                             <form action="{{ route('books.destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </td>
      </tr>
      @empty
      <tr><td colspan="7" class="text-center text-muted">No books found.</td></tr>
      @endforelse
  </tbody>
  </table>
  <div class="d-flex justify-content-center">
    {{ $books->links() }}
  </div>
    @if (session('success'))
    <div class="alert alert-success mt-3" role="alert" >
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @elseif (session('error'))
        <div class="alert alert-danger mt-3" role="alert" >
        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        </div>  
    @endif

</div>  

@endsection