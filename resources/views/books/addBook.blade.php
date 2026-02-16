@extends('layouts.app')

{{-- 
    📝 ADD BOOK VIEW
    This page provides the interface for administrators to add new books to the inventory.
    It features a standard POST form for the book details, plus AJAX-powered modals
    for creating new Authors and Categories on the fly.
--}}

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center font-weight-light my-2">
                    <i class="bi bi-journal-plus"></i> Add New Book
                </h3>
            </div>
            <div class="card-body p-5">
                {{-- 
                    FORM SUBMISSION 
                    This form sends a POST request to the 'store' route.
                    @csrf generates a security token to prevent Cross-Site Request Forgery.
                --}}
                <form method="post" action="{{ route('books.store') }}">
                    @csrf
        
                    <!-- Book Title & ISBN -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label for="title" class="form-label fw-bold text-secondary">Book Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-type-h1"></i></span>
                                <input type="text" id="title" class="form-control" name="title" placeholder="e.g. The Great Gatsby" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="isbn" class="form-label fw-bold text-secondary">ISBN</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-upc-scan"></i></span>
                                <input type="text" id="isbn" class="form-control" name="isbn" placeholder="978-3-16-148410-0" required>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <!-- Category -->
                        <div class="col-md-6 mb-4">
                            <label for="category" class="form-label fw-bold text-secondary">Category</label>
                            <div class="d-flex gap-2">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                                    <select id="category" class="form-select" name="category_id" required>
                                        <option value="" selected disabled>Choose a category...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal" title="New Category">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
        
                        <!-- Author -->
                        <div class="col-md-6 mb-4">
                            <label for="author" class="form-label fw-bold text-secondary">Author</label>
                            <div class="d-flex gap-2">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <select id="author" class="form-select" name="author_id" required>
                                        <option value="" selected disabled>Choose an author...</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addAuthorModal" title="New Author">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                                
                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold text-secondary">Description</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-file-text"></i></span>
                            <textarea id="description" class="form-control" name="description" rows="3" placeholder="Write a short summary of the book..."></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Stock -->
                        <div class="col-md-4 mb-4">
                            <label for="stock" class="form-label fw-bold text-secondary">Stock</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-box-seam"></i></span>
                                <input type="number" id="stock" class="form-control" name="stock" placeholder="0" min="0" required>
                            </div>
                        </div>
        
                        <!-- Cover URL -->
                        <div class="col-md-8 mb-4">
                            <label for="cover" class="form-label fw-bold text-secondary">Cover Image URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-image"></i></span>
                                <input type="text" id="cover" class="form-control" name="cover_url" placeholder="https://example.com/cover.jpg" required>
                            </div>
                        </div>
                    </div>
        
                    <hr class="text-secondary opacity-25">
        
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('books.dashboard') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">
                            <i class="bi bi-save me-1"></i> Save Book
                        </button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success mt-4" role="alert" >
                    {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger mt-4" role="alert" >
                    {{ session('error') }}
                    </div>  
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ================= MODALS ================= -->
{{-- These modals are hidden by default and triggered by the (+) buttons above. --}}

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-tag-fill me-2"></i>Add New Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAddCategory">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Science Fiction">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Author Modal -->
<div class="modal fade" id="addAuthorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-person-fill me-2"></i>Add New Author</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAddAuthor">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Author Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. J.K. Rowling">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Author</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- 
    🚀 AJAX LOGIC (Quick Add)
    This script listens for the submission of the modal forms. 
    Instead of reloading the full page, it uses 'fetch' to send the data to the server.
    If successful, it instantly adds the new Author/Category to the dropdown list.
--}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Generic function to avoid code repetition for Category and Author
        function setupQuickAdd(formId, routeUrl, selectId, modalId, responseKey) {
            const form = document.getElementById(formId);
            if (!form) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Stop normal form submission (No page reload)
                
                let formData = new FormData(this);
                
                // Send data to Laravel Controller
                fetch(routeUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Essential for security
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async response => {
                    const data = await response.json();
                    
                    if (!response.ok) {
                        // Handle Validation Errors (e.g. "Name already taken")
                        if (response.status === 422) {
                            let errors = Object.values(data.errors).flat().join('\n');
                            throw new Error(errors || 'Validation Failed');
                        } else {
                            throw new Error(data.message || 'Server Error (' + response.status + ')');
                        }
                    }
                    return data;
                })
                .then(data => {
                    if(data.success) {
                        // 1. Create a new <option> element for the dropdown
                        let newItem = data[responseKey];
                        let select = document.getElementById(selectId);
                        let option = new Option(newItem.name, newItem.id);
                        
                        // 2. Add it to the list and auto-select it
                        select.add(option);
                        select.value = newItem.id;
                        
                        // 3. Close the popup modal
                        let modalEl = document.getElementById(modalId);
                        let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modal.hide();
                        
                        // 4. Clear the form for next time
                        form.reset();

                    } else {
                        alert('Error: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error: ' + error.message);
                });
            });
        }

        // Initialize for Category Modal
        setupQuickAdd(
            'formAddCategory', 
            "{{ route('categories.store') }}", 
            'category', 
            'addCategoryModal', 
            'category'
        );

        // Initialize for Author Modal
        setupQuickAdd(
            'formAddAuthor', 
            "{{ route('authors.store') }}", 
            'author', 
            'addAuthorModal', 
            'author'
        );
    });
</script>

@endsection