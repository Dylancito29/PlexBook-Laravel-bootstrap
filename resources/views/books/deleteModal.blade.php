
@extends('layaouts.app')
@section('content')

<div class="card" >

  
  <div class="card-body">
    <h5 class="card-title">Eliminar un libro</h5>
    <form  method="post" action="{{ route('libros.destroy') }}">
      @csrf
        <div class="form-group" >
            <label for="libro_id">Id del libro:</label>
            <input type="text" id="libro_id" class="form-control" name="libro_id" required>
        </div>
        
        <button type="submit"  class="btn btn-success" >Eliminar</button>

    </form>
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
</div>

@endsection