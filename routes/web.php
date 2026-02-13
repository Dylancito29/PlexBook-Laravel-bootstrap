<?php

use App\Book;
use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', [BooksController::class, 'dashboard'] )->name('books.dashboard');
Route::get('/Books/add',[BooksController::class, 'add'])->name('books.add');
Route::post('/Books/store',[BooksController::class,'store'])->name('books.store');
Route::get('/Books/catalog',[BooksController::class,'catalog'])->name('books.catalog') ;
Route::put('/Books/{book}',[BooksController::class,'update'])->name('books.update');
// Route::post('/Books/{book}/lend',[BooksController::class,'lend'])->name('books.lend');
Route::get('/Books/lend',[BooksController::class,'lendView'])->name('books.lendView');
Route::post('/Books/{book}/lend',[BooksController::class,'lend'])->name('books.lendAction');
Route::get('/Books/update',[BooksController::class,'updateView'])->name('books.updateView');

Route::get('/Books/delete',[BooksController::class,'delete'])->name('books.delete');
Route::post('/Books/destroy',[BooksController::class,'destroy'])->name('books.destroy');
Route::get('/Books/cart',[BooksController::class,'cart'])->name('books.cart');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
