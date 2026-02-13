<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlexBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  </head>
  <body>
  <div>

    <nav class="navbar bg-dark fixed-top navbar-dark shadow-sm">
       <div class="container-fluid">
         <a class="navbar-brand text-white" href="{{ route('books.dashboard') }}">
           <div class="d-flex align-items-center gap-2">
             <i class="bi bi-journal-bookmark fs-2"></i>
             <h1 class="m-0 fs-3">PlexBook</h1>
           </div>
         </a>

         <div class="d-flex align-items-center gap-3">
             {{-- Cart Icon --}}
             <a href="{{ route('books.cart') }}" class="text-white position-relative text-decoration-none">
                <i class="bi bi-cart3 fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light" style="font-size: 0.6rem;">
                    0
                    <span class="visually-hidden">unread messages</span>
                </span>
             </a>

             <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
             </button>
         </div>

         <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
           <div class="offcanvas-header bg-gradient bg-dark text-white border-bottom border-secondary">
             <div class="d-flex align-items-center gap-3">
                 <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px;">
                    U
                 </div>
                 <div>
                     <h5 class="offcanvas-title mb-0" id="offcanvasNavbarLabel">User Menu</h5>
                     <small class="text-white-50">Welcome back!</small>
                 </div>
             </div>
             <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
           </div>
           
           <div class="offcanvas-body d-flex flex-column p-0">
             <!-- Search Section -->
             <div class="p-3 border-bottom">
                 <form class="d-flex" role="search" action="{{ route('books.catalog') }}" method="GET">
                   <div class="input-group">
                     <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                     <input class="form-control border-start-0 bg-light" type="search" name="query" placeholder="Find your next book..." aria-label="Search"/>
                   </div>
                 </form>
             </div>

             <!-- Navigation Links -->
             <div class="flex-grow-1 overflow-auto">
                 <ul class="nav flex-column p-2 gap-1">
                    <li class="nav-item">
                        <small class="text-uppercase text-muted fw-bold ms-3 mt-3 mb-1 d-block" style="font-size: 0.75rem;">Main Menu</small>
                    </li>
                   <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('books.dashboard') ? 'bg-primary text-white active-link' : 'text-dark hover-bg-light' }}" aria-current="page" href="{{ route('books.dashboard') }}">
                        <i class="bi bi-house-door fs-5"></i> 
                        <span>Home</span>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('books.catalog') ? 'bg-primary text-white active-link' : 'text-dark hover-bg-light' }}" href="{{ route('books.catalog') }}">
                        <i class="bi bi-collection fs-5"></i> 
                        <span>Catalog</span>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('books.cart') ? 'bg-primary text-white active-link' : 'text-dark hover-bg-light' }}" href="{{ route('books.cart') }}">
                        <i class="bi bi-cart fs-5"></i> 
                        <span>Shopping Cart</span>
                     </a>
                   </li>

                   <li class="nav-item">
                        <small class="text-uppercase text-muted fw-bold ms-3 mt-4 mb-1 d-block" style="font-size: 0.75rem;">Administrator</small>
                   </li>
                   
                   <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded text-dark hover-bg-light" data-bs-toggle="collapse" href="#adminCollapse" role="button" aria-expanded="false" aria-controls="adminCollapse">
                            <i class="bi bi-gear fs-5"></i>
                            <div class="d-flex justify-content-between flex-grow-1 align-items-center">
                                <span>Management</span>
                                <i class="bi bi-chevron-down small"></i>
                            </div>
                        </a>
                        <div class="collapse {{ request()->is('Books/add') || request()->is('Books/update') || request()->is('Books/delete') || request()->is('Books/lend') ? 'show' : '' }}" id="adminCollapse">
                            <ul class="nav flex-column ms-3 ps-3 border-start border-2 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link py-2 d-flex align-items-center gap-2 {{ request()->routeIs('books.add') ? 'text-primary fw-bold' : 'text-secondary' }}" href="{{ route('books.add') }}">
                                        <i class="bi bi-plus-circle"></i> Add Book
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-2 d-flex align-items-center gap-2 {{ request()->routeIs('books.updateView') ? 'text-primary fw-bold' : 'text-secondary' }}" href="{{ route('books.updateView') }}">
                                        <i class="bi bi-pencil-square"></i> Update Book
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-2 d-flex align-items-center gap-2 {{ request()->routeIs('books.delete') ? 'text-primary fw-bold' : 'text-secondary' }}" href="{{ route('books.delete') }}">
                                        <i class="bi bi-trash"></i> Delete Book
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-2 d-flex align-items-center gap-2 {{ request()->routeIs('books.lendView') ? 'text-primary fw-bold' : 'text-secondary' }}" href="{{ route('books.lendView') }}">
                                        <i class="bi bi-journal-arrow-up"></i> Lend Book
                                    </a>
                                </li>
                            </ul>
                        </div>
                   </li>
                 </ul>
             </div>

             <!-- Footer Section -->
             <div class="p-3 border-top bg-light">
                 <div class="d-grid gap-2">
                     <button class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-2">
                         <i class="bi bi-box-arrow-right"></i> Log Out
                     </button>
                 </div>
                 <div class="text-center mt-3 text-muted" style="font-size: 0.7rem;">
                     PlexBook v1.0 &copy; {{ date('Y') }}
                 </div>
             </div>
           </div>
         </div>
       </div>
     </nav>
  </div>

    <div class="container" style="margin-top: 120px;">
      @yield('content')

    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>