<?php

use App\Http\Controllers\LibrosController;
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

Route::get('/libros/crear',[LibrosController::class, 'crear'])->name('libros.crear');
Route::post('/libros/store',[LibrosController::class,'store'])->name('libros.store');
Route::get('/libros/leer',[LibrosController::class,'leer'])->name('libros.leer');
Route::put('/libros/{libro}',[LibrosController::class,'update'])->name('libros.update');

Route::get('/libros/eliminar',[LibrosController::class,'eliminar'])->name('libros.eliminar');
Route::post('/libros/destroy',[LibrosController::class,'destroy'])->name('libros.destroy');