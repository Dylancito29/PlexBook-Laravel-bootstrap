@extends('layouts.app')
@section('content')


<div class="card p-3 shadow-sm">
  <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="text-danger"><i class="bi bi-trash"></i> Delete Books</h1>
        <p class="text-muted">Select a book to permanently delete from the catalog.</p>
      </div>
  </div>
  
  <div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead class="table-light">
      <tr align="center">
        <th scope="col">ID</th>
        <th scope="col">Cover</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Stock</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $book)
      <tr align="center">
        <th scope="row">{{ $book->id }}</th>
        <td><img src="{{ $book->cover_url }}" alt="Book Cover" class="rounded shadow-sm" style="width: 40px; height: 60px; object-fit: cover;"></td>
        <td class="fw-bold">{{ $book->title }}</td>
        <td>{{ $book->category->name }}</td>
        <td>{{ $book->stock }}</td>
  
        <td>
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $book->id }}">
                <i class="bi bi-trash-fill"></i> Delete
            </button>
            
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $book->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteModalLabel{{ $book->id }}">Confirm Deletion</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="mb-4">Are you sure you want to delete <strong>"{{ $book->title }}"</strong>?</p>
                            <p class="text-muted small">This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('books.destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-danger">Yes, Delete it!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
      </tr>
      @empty
        <tr>
            <td colspan="6" class="text-center py-4 text-muted">No books available to delete.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
  </div>
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