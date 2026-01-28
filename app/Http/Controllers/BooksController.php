<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;

class BooksController extends Controller
{
    public function crear(){
        return view('books.crear');
    }
    public function dashboard(){
        return view('books.dashboard');
    }
    public function store(Request $request){
        // Lógica para almacenar el libro
        $request->validate([
            'nombre'=>'required|string|max:255',
            'descripcion'=>'required|string',
            'autor'=>'required|string|max:255'
        ]);
        
        $libro = new Books();
        $libro->title = $request->title;
        $libro->category = $request->category;
        $libro->author = $request->author;
        $libro->stock = $request->stock;
        $libro->cover = $request->cover;

        $libro->save();

        return redirect()->back()->with('success','Libro creado con exito!');


    }
    public function catalog(){
        $books = books::all();
        return view('books.catalog', compact('books'));

    }

    public function update(Request $request, Books $book){
        $request->validate([
            'title'=>'required|string|max:255',
            'category'=>'required|string|max:255',
            'author'=>'required|string|max:255',
            'stock'=>'required|integer',
            'cover'=>'required|string|max:255'
        ]);
        $book->update($request->all());
        return redirect()->back()->with('success','Book updated successfully!');
        
    }
    public function eliminar(){
        $libros = Books::all();
        return view('books.eliminar', compact('libros'));
    }
    public function destroy(Request $request){
        $Id = $request->input('libro_id');
        $libro = Books::find($Id);
        if($libro){
            $libro->delete();
            return redirect()->back()->with('success','Libro eliminado con exito!');
        }else{
            return redirect()->back()->with('error','Libro no encontrado.');
        }
    }





}
