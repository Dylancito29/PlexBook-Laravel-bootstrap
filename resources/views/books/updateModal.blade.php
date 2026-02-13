
<!-- Modal -->
<div class="modal fade" id="modalUpdate{{ $book->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Book</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form method="post" action="{{ route('books.update', $book->id) }}">
            @csrf
            @method('PUT')

            <div class="d-flex justify-content-center mb-4">
                <div class="card shadow-sm" style="width: 10rem;">
                  <img class="card-img-top" src="{{ $book->cover_url }}" alt="Cover" style="height: 15rem; object-fit: cover;">
                </div>
            </div>

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label fw-bold text-secondary">Book Title</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-type-h1"></i></span>
                    <input type="text" id="title" class="form-control" value="{{ $book->title }}" name="title" required>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Category -->
                <div class="col-md-6">
                    <label for="category" class="form-label fw-bold text-secondary">Category</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                        <select id="category" class="form-select" name="category_id" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Author -->
                <div class="col-md-6">
                    <label for="author" class="form-label fw-bold text-secondary">Author</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                        <select id="author" class="form-select" name="author_id" required>
                             @foreach($authors as $aut)
                                <option value="{{ $aut->id }}" {{ $book->author_id == $aut->id ? 'selected' : '' }}>{{ $aut->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label fw-bold text-secondary">Description</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-file-text"></i></span>
                    <textarea id="description" class="form-control" name="description" rows="3">{{ $book->description }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                 <!-- Stock -->
                 <div class="col-md-4">
                    <label for="stock" class="form-label fw-bold text-secondary">Stock</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-box-seam"></i></span>
                        <input type="number" id="stock" class="form-control" value="{{ $book->stock }}" name="stock" required>
                    </div>
                </div>

                <!-- Cover URL -->
                <div class="col-md-8">
                    <label for="cover" class="form-label fw-bold text-secondary">Cover URL</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-image"></i></span>
                        <input type="text" id="cover" class="form-control" value="{{ $book->cover_url }}" name="cover" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Book</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

