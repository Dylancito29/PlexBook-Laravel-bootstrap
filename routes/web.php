<?php

use App\Books;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Books/dashboard', [BooksController::class, 'dashboard'] )->name('books.dashboard');
Route::get('/Books/add',[BooksController::class, 'add'])->name('books.add');
Route::post('/Books/store',[BooksController::class,'store'])->name('books.store');
Route::get('/Books/catalog',[BooksController::class,'catalog'])->name('books.catalog') ;
Route::put('/Books/{book}',[BooksController::class,'update'])->name('books.update');
Route::post('/Books/{book}/lend',[BooksController::class,'lend'])->name('books.lend');
Route::get('/Books/update',[BooksController::class,'updateView'])->name('books.updateView');

Route::get('/Books/delete',[BooksController::class,'delete'])->name('books.delete');
Route::post('/Books/destroy',[BooksController::class,'destroy'])->name('books.destroy');