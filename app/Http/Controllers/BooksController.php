<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Category;

class BooksController extends Controller
{
    public function create(){
        return view('books.create');
    }
    public function dashboard(){
        return view('books.dashboard');
    }
    public function store(Request $request){
        // Lógica para almacenar el libro
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string|max:1000', // Agregamos validación para descripción
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'stock'=>'required|integer',
            'cover'=>'required|string|max:255'
        ]);
        
        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description; // Guardamos la descripción
        $book->category_id = $request->category_id;
        $book->author_id = $request->author_id;
        $book->stock = $request->stock;
        $book->cover_url = $request->cover;
        
        $book->save();

        
        return redirect()->back()->with('success','Book created successfully!');


    }
    public function catalog(Request $request){
        $categories = Category::all();
        $authors = Author::all();
        
        // Obtener libros para el carrusel (siempre todos o una selección, independiente de la búsqueda)
        $carouselBooks = Book::latest()->take(10)->get(); 

        $query = $request->get('query'); // 1. Capturas lo que el usuario escribió

        if ($query) {
            // 2. Si escribió algo, buscas coincidencias en el título
            $books = Book::where('title', 'like', '%' . $query . '%')->paginate(5);
        } else {
            // 3. Si no escribió nada (o es la primera vez que entra), muestras todo normal
            $books = Book::paginate(5);
        }
        
        // Pasamos también la variable $carouselBooks a la vista
        return view('books.catalog', compact('books','categories', 'authors', 'carouselBooks'));

    }

    public function update(Request $request, Book $book){
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'stock'=>'required|integer',
            'cover'=>'required|string|max:255'
        ]);
        
        $book->title = $request->title;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->author_id = $request->author_id;
        $book->stock = $request->stock;
        $book->cover_url = $request->cover;
        
        $book->save();

        return redirect()->back()->with('success','Book updated successfully!');
        
    }
    public function delete(){
        $books = Books::all();
        return view('books.delete', compact('books'));
    }
    public function destroy(Request $request){
        $Id = $request->input('book_id');
        $book = Book::find($Id); // Changed Books to Book to use the correct model name
        if($book){
            $book->delete();
            return redirect()->back()->with('success','Book deleted successfully!');
        }else{
            return redirect()->back()->with('error','Book not found.');
        }
    }

    public function lendView() {
        // Simple view for now, or listing books to lend
        // If lend.blade.php is empty, we should fill it or redirect to catalog
        return redirect()->route('books.catalog')->with('success', 'Please select a book to lend from the catalog.');
    }

    public function cart(){
        return view('books.cart');
    }





}
