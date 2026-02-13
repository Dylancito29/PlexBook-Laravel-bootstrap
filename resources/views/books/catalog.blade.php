@extends('layaouts.app')
@section('content')

<div class="">
  <h1>Thousands of titles to read</h1>
</div>

@include('books.carousel')

<div class="card p-3" >
  <div class="row">
    <div class="col-6" >
      <h1>Book list</h1>
    </div>
    <div class="d-flex col-6 mb-3 gap-2 align-items-center justify-content-end" >
      
    <form action="{{ route('books.catalog') }}" method="GET">
        <div class="input-group w-auto">
            <input type="text" name="query" class="form-control" placeholder="Search Book" aria-label="Input group example" aria-describedby="btnGroupAddon2">
            <button type="submit" class="input-group-text btn btn-outline-primary" id="btnGroupAddon2">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddBook" >add new book <i class="bi bi-plus"></i></button>
            @include('books.addModal')
        </div>


    </div>

  </div>
  
  
  <table class="table table-striped table-hover">
    <thead>
      <tr align="center" >
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
      @foreach($books as $book)
      <tr style="vertical-align: middle; justify-items: center; " align="center">
        <th scope="row">{{ $book->id }}</th>
  
        
        <td><img src="{{ $book->cover_url }}" alt="Book Cover" style="width: 50px; height: auto;"></td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->category->name }}</td>
        <td>{{ optional($book->author)->name }}</td>
        <td>{{ $book->stock }}</td>
  
        <td>
          <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalShowBook{{ $book->id }}" >
              <i class="bi bi-eye"></i>
            </button>
            @include('books.showBook', ['book' => $book])
            
            
          </div>
        </td>
          {{-- @include('books.update') --}}
        
      </tr>
      @endforeach
  </tbody>
  </table>
  <div class="d-flex justify-content-center">
    {{ $books->links() }}
  </div>
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

@endsection