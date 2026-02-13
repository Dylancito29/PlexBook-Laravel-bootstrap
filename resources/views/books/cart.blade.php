@extends('layaouts.app')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0">
                <h2 class="mb-0"><i class="bi bi-cart3"></i> Shopping Cart</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    Your cart is currently empty. <a href="{{ route('books.catalog') }}" class="alert-link">Start shopping!</a>
                </div>
                
                {{-- Example Item Structure (Commented out for now)
                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                    <img src="url" class="img-fluid rounded me-3" style="width: 80px; height: 120px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">Book Title</h5>
                        <p class="mb-1 text-muted">Author Name</p>
                        <h6 class="mb-0">$19.99</h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="number" class="form-control me-3" value="1" style="width: 70px;">
                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
                --}}

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0">
                <h4 class="mb-0">Summary</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>$0.00</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Tax</span>
                    <span>$0.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <strong>Total</strong>
                    <strong>$0.00</strong>
                </div>
                <button class="btn btn-primary w-100 btn-lg">Checkout</button>
            </div>
        </div>
    </div>
</div>

@endsection
