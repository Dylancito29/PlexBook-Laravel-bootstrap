@extends('layaouts.app')
@section('content')

<div class="card" >

  
  <div class="card-body">
    <h5 class="card-title">Añadir un libro</h5>
    <form  method="post" action="{{ route('libros.store') }}">
      @csrf
        <div class="form-group" >
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" class="form-control" name="nombre" required>
        </div>
        <div class="form-group" >
            <label for="descripcion">Description</label>
            <input type="text" id="descripcion" class="form-control" name="descripcion" required>
        </div>
        <div class="form-group" >
            <label for="autor">Autor</label>
            <input type="text" id="autor" class="form-control" name="autor" required>
        </div>
        <button type="submit"  class="btn btn-success" >Guardar</button>

    </form>
      @if (session('success'))
        <div class="alert alert-success" role="alert" >
          {{ session('success') }}
        </div>
      
      @endif
    
    
  </div>
</div>

@endsection