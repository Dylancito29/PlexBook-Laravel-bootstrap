@extends('layaouts.app')
@section('content')

<style>
  .hover-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .hover-card:hover {
      transform: scale(1.03);
      box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
      cursor: pointer;
      z-index: 10;
  }
  
  .card-link {
      text-decoration: none;
      color: inherit;
      display: block;
  }
</style>

<h1>Welcome, what would you like to do today?</h1>

<div class="row row-cols-1 row-cols-md-2 g-4 mt-4 ">

  <div class="col">
    <a href="{{ route('books.catalog') }}" class="card-link">
      <div class="card shadow-lg bg-body rounded hover-card" style="height: 250px; overflow: hidden;">
        <div class="row g-0 h-100">
            <div class="col-6 p-0 h-100" >
              <img src="https://images.unsplash.com/photo-1661827291034-a7afb7dd1601?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bXVjaG9zJTIwbGlicm9zfGVufDB8fDB8fHww" class="img-fluid rounded-start w-100 h-100" style="object-fit: cover;" >
            </div>  
            <div class="col-6" >
                <div class="card-body h-100 d-flex flex-column justify-content-center">
                  <h5 class="card-title">Go to Catalog</h5>
                  <p class="card-text">Browse the complete collection of books available in our library. Find your next read today!</p>
                </div>
            </div>
        </div>
      </div>
    </a>
  </div>

  <div class="col">
    <a href="{{ route('books.add') }}" class="card-link">
      <div class="card shadow-lg bg-body rounded hover-card" style="height: 250px; overflow: hidden;">
        <div class="row g-0 h-100">
            <div class="col-6 p-0 h-100" >
              <img src="https://st.depositphotos.com/1035837/1375/i/450/depositphotos_13755368-stock-photo-open-book-isolated.jpg" class="img-fluid rounded-start w-100 h-100" style="object-fit: cover;" >
            </div>  
            <div class="col-6" >
                <div class="card-body h-100 d-flex flex-column justify-content-center">
                  <h5 class="card-title">Add a new Book!</h5>
                  <p class="card-text">Easily add a new book to our collection and share it with the community.</p>
                </div>
            </div>
        </div>
      </div>
    </a>
  </div>

  <div class="col">
    <a href="{{ route('books.delete') }}" class="card-link">
      <div class="card shadow-lg bg-body rounded hover-card" style="height: 250px; overflow: hidden;">
        <div class="row g-0 h-100">
            <div class="col-6 p-0 h-100" >
              <img src="https://media.istockphoto.com/id/1273544978/es/foto/libro-abierto-con-p%C3%A1ginas-sobre-un-fondo-rojo.jpg?s=612x612&w=0&k=20&c=G0Qdk1yRtXaKfZZCENl2JebVnck0Ca718mRjqaTTF14=" class="img-fluid rounded-start w-100 h-100" style="object-fit: cover;" >
            </div>  
            <div class="col-6" >
                <div class="card-body h-100 d-flex flex-column justify-content-center">
                  <h5 class="card-title">Delete a Book!</h5>
                  <p class="card-text">Easily remove a book from our collection when it's no longer available or relevant.</p>
                </div>
            </div>
        </div>
      </div>
    </a>
  </div>

  <div class="col">
    <a href="#" class="card-link">
      <div class="card shadow-lg bg-body rounded hover-card" style="height: 250px; overflow: hidden;">
        <div class="row g-0 h-100">
            <div class="col-6 p-0 h-100" >
              <img src="https://i0.wp.com/www.infotecarios.com/wp-content/uploads/digital-libraries.jpg?fit=1000%2C702&ssl=1" class="img-fluid rounded-start w-100 h-100" style="object-fit: cover;" >
            </div>  
            <div class="col-6" >
                <div class="card-body h-100 d-flex flex-column justify-content-center">
                  <h5 class="card-title">Lend a Book!</h5>
                  <p class="card-text">Easily lend a book to friends or family and keep track of borrowed items.</p>
                </div>
            </div>
        </div>
      </div>
    </a>
  </div>
  
</div>



@endsection
