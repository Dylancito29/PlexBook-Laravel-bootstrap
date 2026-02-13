
<!-- Modal -->
<div class="modal fade" id="modalAddBook" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Mayor tamaño y centrado -->
    <div class="modal-content border-0 shadow-lg">
      
      <!-- Header con estilo -->
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5 d-flex align-items-center gap-2" id="staticBackdropLabel">
            <i class="bi bi-journal-plus"></i> Add New Book
        </h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4">
        <form method="post" action="{{ route('books.store') }}">
            @csrf

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="form-label fw-bold text-secondary">Book Title</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-type-h1"></i></span>
                    <input type="text" id="title" class="form-control" name="title" placeholder="e.g. The Great Gatsby" required>
                </div>
            </div>

            
            <div class="row mb-4">
              <!-- Categoría -->
              <div class="col-md-6">
                <label for="category" class="form-label fw-bold text-secondary">Category</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                  <select id="category" class="form-select" name="category_id" required>
                    <option value="" selected disabled>Choose a category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Autor -->
                <div class="col-md-6">
                    <label for="author" class="form-label fw-bold text-secondary">Author</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                        <select id="author" class="form-select" name="author_id" required>
                            <option value="" selected disabled>Choose an author...</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row mb-4">
              <!-- Descripción -->
               <div class="mb-4">
                  <label for="description" class="form-label fw-bold text-secondary">Description</label>
                  <div class="input-group">
                      <span class="input-group-text bg-light"><i class="bi bi-file-text"></i></span>
                      <textarea id="description" class="form-control" name="description" rows="3" placeholder="Write a short summary of the book..."></textarea>
                  </div>
              </div>
                <!-- Stock -->
                <div class="col-md-4">
                    <label for="stock" class="form-label fw-bold text-secondary">Stock</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-box-seam"></i></span>
                        <input type="number" id="stock" class="form-control" name="stock" placeholder="0" min="0" required>
                    </div>
                </div>

                <!-- Cover URL -->
                <div class="col-md-8">
                    <label for="cover" class="form-label fw-bold text-secondary">Cover Image URL</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-image"></i></span>
                        <input type="text" id="cover" class="form-control" name="cover" placeholder="https://example.com/cover.jpg" required>
                    </div>
                </div>
            </div>

            <!-- Separador -->
            <hr class="text-secondary opacity-25">

            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary px-4 fw-bold">
                    <i class="bi bi-save me-1"></i> Save Book
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>