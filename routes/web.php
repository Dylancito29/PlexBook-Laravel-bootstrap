<?php

use App\Book;
use App\Http\Controllers\BooksController;
use App\Role;
use Illuminate\Support\Facades\Route;

/**
 * 🗺️ ROUTES: The Library Map
 * 
 * This file acts as the directory map for the application.
 * It tells the system: "When a user goes to THIS url, execute THAT function."
 */

// ====================================================
// 🌍 PUBLIC AREA (The Lobby)
// Everyone can access these pages, even without a library card.
// ====================================================

// The Landing Page (Dashboard)
Route::get('/', [BooksController::class, 'dashboard'] )->name('books.dashboard');

// The Bookshelf (Catalog)
Route::get('/Books/catalog',[BooksController::class,'catalog'])->name('books.catalog') ;


// ====================================================
// 🔐 MEMBERS ONLY AREA (The Reading Room)
// Requires a valid library card (Login) to enter.
// Middleware: 'auth' checks if the user is logged in.
// ====================================================
Route::middleware(['auth'])->group(function () {
    
    // --- 🛒 Shopping Cart Actions ---
    // Actions related to picking up books and carrying them around.
    
    // View your backpack (Cart)
    Route::get('/Books/cart',[BooksController::class,'cart'])->name('books.cart');
    
    // Pick up a book (Add to Cart)
    Route::get('/Books/add-to-cart/{id}',[BooksController::class, 'addToCart'])->name('books.addToCart');
    
    // Put a book back on the shelf (Remove from Cart)
    Route::get('/Books/remove-from-cart/{id}', [BooksController::class,'removeFromCart'])->name('books.removeFromCart');
    
    // Checkout Desk (Confirm Loan)
    Route::post('/Books/process-loan', [BooksController::class, 'processLoan'])->name('books.processLoan');
    
    // My History (Loans made by this user)
    Route::get('/my-loans', [BooksController::class, 'myLoans'])->name('books.myLoans');
    
    // Legacy/Helper lending routes
    Route::post('/Books/{book}/lend',[BooksController::class,'lend'])->name('books.lendAction');
    Route::get('/Books/lend',[BooksController::class,'lendView'])->name('books.lendView');


    // ====================================================
    // 🛡️ STAFF ONLY AREA (The Back Office)
    // Restricted to Administrators.
    // Middleware: 'admin' acts as the security guard checking badges.
    // ====================================================
    Route::middleware(['admin'])->group(function () {
        
        // --- ➕ Book Acquisition (Create) ---
        Route::get('/Books/add',[BooksController::class, 'add'])->name('books.add');
        Route::post('/Books/store',[BooksController::class,'store'])->name('books.store');
        
        // --- ✏️  Book Maintenance (Update) ---
        Route::get('/Books/update',[BooksController::class,'updateView'])->name('books.updateView');
        Route::put('/Books/{book}',[BooksController::class,'update'])->name('books.update');
        
        // --- 🗑️ Book Retirement (Delete) ---
        Route::get('/Books/delete',[BooksController::class,'delete'])->name('books.delete');
        Route::post('/Books/destroy',[BooksController::class,'destroy'])->name('books.destroy');
        
        // --- 📋 Management (Loans & Returns) ---
        Route::get('/loans/active', [BooksController::class, 'activeLoans'])->name('loans.active');
        Route::post('/loans/return/{id}', [BooksController::class, 'returnBook'])->name('loans.return');

        // --- ⚡ Quick Actions (AJAX) ---
        Route::post('/categories/store', [BooksController::class, 'storeCategory'])->name('categories.store');
        Route::post('/authors/store', [BooksController::class, 'storeAuthor'])->name('authors.store');
    });

});

// Standard Authentication Routes (Login, Register, Reset Password)
// These are generated automatically by Laravel.
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
