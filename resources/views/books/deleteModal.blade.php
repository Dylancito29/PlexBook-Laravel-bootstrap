
@extends('layouts.app')
@section('content')

<div class="card" >

  
  <div class="card-body">
    <h5 class="card-title">Delete Book</h5>
    <form  method="post" action="{{ route('books.destroy') }}">
      @csrf
        <div class="form-group" >
            <label for="book_id">Book Id:</label>
            <input type="text" id="book_id" class="form-control" name="book_id" required>
        </div>
        
        <button type="submit"  class="btn btn-success" >Delete</button>

    </form>
    
    
  </div>
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
@endsection