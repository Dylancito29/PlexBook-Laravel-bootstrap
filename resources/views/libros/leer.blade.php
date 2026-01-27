@extends('layaouts.app')
@section('content')

<h1>Lista de Libros</h1>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripción</th>
      <th scope="col">Autor</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($libros as $libro)
    <t>
      <th scope="row">{{ $libro->id }}</th>
      <td>{{ $libro->nombre }}</td>
      <td>{{ $libro->descripcion }}</td>
      <td>{{ $libro->autor }}</td>
      <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal{{ $libro->id }}" >Editar</button></td>
        @include('libros.actualizar')
    </tr>
    @endforeach
</tbody>
</table>
@if (session('success'))
<div class="alert alert-success" role="alert" >
{{ session('success') }}
</div>
@elseif (session('error'))
    <div class="alert alert-danger" role="alert" >
    {{ session('error') }}
    </div>  
@endif


@endsection