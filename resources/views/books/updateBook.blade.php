@extends('layouts.app')
@section('content')

<div class="card p-3 shadow-sm" >
  <div class="row align-items-center mb-4">
    <div class="col-6" >
      <h1 class="text-primary"><i class="bi bi-pencil-square"></i> Update Books</h1>
      <p class="text-muted">Select a book to update its details.</p>
    </div>
    <div class="col-6" >
      {{-- Optional Search --}}
    </div>
  </div>
  
  <table class="table table-striped table-hover align-middle">
    <thead class="table-light">
      <tr align="center">
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
      @forelse($books as $book)
      <tr align="center">
        <th scope="row">{{ $book->id }}</th>
        <td><img src="{{ $book->cover_url }}" alt="Book Cover" class="rounded shadow-sm" style="width: 50px; height: 75px; object-fit: cover;"></td>
        <td class="fw-bold">{{ $book->title }}</td>
        <td>{{ $book->category->name }}</td>
        <td>{{ optional($book->author)->name }}</td>
        <td>
            <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                {{ $book->stock }}
            </span>
        </td>
  
        <td>
          <div>
            <button type="button" class="btn btn-warning text-white btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $book->id }}" title="Edit Book">
              <i class="bi bi-pencil"></i> Update
            </button>
            
            {{-- Include the Update Modal for each book --}}
            @include('books.updateModal', ['book' => $book])
            
          </div>
        </td>
      </tr>
      @empty
        <tr>
            <td colspan="7" class="text-center py-4 text-muted">No books found to update.</td>
        </tr>
      @endforelse
  </tbody>
  </table>

  @if (session('success'))
  <div class="alert alert-success mt-3" role="alert" >
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
  </div>
  @elseif (session('error'))
      <div class="alert alert-danger mt-3" role="alert" >
        <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
      </div>  
  @endif

</div>  

@endsection