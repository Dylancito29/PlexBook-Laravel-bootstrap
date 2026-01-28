<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modal{{ $libro->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  method="post" action="{{ route('libros.update', $libro->id) }}">
      @csrf
      @method('PUT')
        <div class="form-group" >
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" class="form-control" value="{{ $libro->nombre }}" name="nombre" required>
        </div>
        <div class="form-group" >
            <label for="descripcion">Description</label>
            <input type="text" id="descripcion" class="form-control" value="{{ $libro->descripcion }}" name="descripcion" required>
        </div>
        <div class="form-group" >
            <label for="autor">Autor</label>
            <input type="text" id="autor" class="form-control" value="{{ $libro->autor }}" name="autor" required>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
    </form>
</div>
</div>
</div>

