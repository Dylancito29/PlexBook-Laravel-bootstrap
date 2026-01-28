<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  </head>
  <body>
  <div>

    <nav class="navbar bg-dark  fixed-top">
       <div class="container-fluid">
         <a class="navbar-brand text-white " href="#">
           <div  >
             <h1>PlexBook <i class="bi bi-journal-bookmark"></i></h1>
             
 
           </div>
         </a>
         <button class="navbar-toggler" style="border-color: gray;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
         </button>
         <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
           <div class="offcanvas-header">
             <h5 class="offcanvas-title" id="offcanvasNavbarLabel">PlexBook Options</h5>
             <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
           </div>
           <div class="offcanvas-body">
             <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
               <li class="nav-item">
                 <a class="nav-link active" aria-current="page" href="/Books/dashboard">Home</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="/Books/catalog">Books Catalog</a>
               </li>
               <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                   Managing of books
                 </a>
                 <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <li><a class="dropdown-item" href="/Books/add">Add Book</a></li>
                   <li><a class="dropdown-item" href="/Books/update">Update Book</a></li>
                   <li><a class="dropdown-item" href="/Books/delete">Delete a book</a></li>      
                   <li><a class="dropdown-item" href="/Books/lend">Lend a book</a></li>      
                 </ul>
               </li>
             </ul>
             <form class="d-flex mt-3" role="search">
               <div class="input-group"  >
                 <input class="form-control" type="search" placeholder="Search Book" aria-label="Search"/>
                 <button class="btn btn-outline-success" type="submit">Search</button>
               </div>
 
             </form>
           </div>
         </div>
       </div>
     </nav>
  </div>

    <div class="container" style="margin-top: 120px;">
      @yield('content')

    </div>
    

    

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>