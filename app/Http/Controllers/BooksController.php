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
    public function addToCart($id){
        // 1. The Search (The Librarian looks for the book)
        // We look for the book in the database using its ID.
        $book = Book::find($id);

        // If the book is not on the shelf (database), we apologize and return.
        if(!$book){
            return redirect()->back()->with('error',"Book doesn't found.");
        }

        // 2. The Bag (Retrieving the session)
        // We ask for the 'cart' from the user's session (their personal locker).
        // If the confirmed locker is empty or doesn't exist, we give them an empty array [].
        $cart = session()->get('cart',[]);

        // 3. The Rules (Capacity Check)
        // Analogy: You only have two hands. You can't carry more than 5 books at once.
        if(count($cart) >= 5 ){
            return redirect()->back()->with('error','you only could lend until 5 books.');
        }

        // 4. The Duplicate Check
        // Analogy: You cannot borrow the exact same copy of a book twice.
        if (isset($cart[$id])){
            return redirect()->back()->with('error','you already have this book in your list');
        }

        // 5. Filling the Form (Preparing the data)
        // We package the book details to put into the bag.
        // NOTE: We use 'cover_msg' here to match what the View expects later.
        $cart[$id] = [
            'title' => $book->title,
            'quantity' => 1,
            'cover' => $book->cover_url, 
            'author' => optional($book->author)->name,
            'category' => $book->category->name,
        ];

        // 6. Storing the Bag (Saving to Session)
        // Analogy: We put the updated bag back into the user's locker so it's there on the next page load.
        // 'cart' is the label on the locker, $cart is the content.
        session()->put('cart',$cart);

        return redirect()->back()->with('success','Book added to your borrow list.' );

    }

    // 7. Remove from Cart (Putting it back on the shelf)
    // This function handles the request to remove a specific book from the session 'cart'.
    public function removeFromCart($id)
    {
        // Get the current cart from the session.
        $cart = session()->get('cart');

        // Check if the book exists in the cart before trying to remove it.
        if(isset($cart[$id])) {
            // Remove the book from the array.
            unset($cart[$id]);
            
            // Save the updated cart back to the session.
            // If we don't save it, the book will reappear on the next page refresh!
            session()->put('cart', $cart);
        }

        // Send the user back to the cart page with a success message.
        return redirect()->back()->with('success', 'Book removed from lending list successfully!');
    }

    // 8. Process Loan (The Library Checkout Desk)
    // This is the final step where we commit the loan to the database.
    public function processLoan(Request $request)
    {
        // Get the cart from the session.
        $cart = session()->get('cart');
        
        // Safety Check: Is the cart empty?
        if(!$cart) {
             return redirect()->back()->with('error', 'Your lending list is empty!');
        }

        // Authentication Check: We need to know WHO is borrowing the books.
        // If the user is not logged in, we can't create a loan record for them.
        if (!auth()->check()) {
             return redirect()->route('login')->with('error', 'Please login to process your loan.');
        }

        // Iterate through each book in the cart and create a loan record.
        foreach($cart as $id => $details) {
            
            // Create a new Loan instance (Model).
            $loan = new \App\Loan();
            
            // Set the user ID to the currently logged-in user.
            $loan->user_id = auth()->id();
            
            // Set the book ID.
            $loan->book_id = $id;
            
            // Set the loan date to right now.
            $loan->loan_date = now();
            
            // Set the return date to 15 days from now.
            $loan->return_date = now()->addDays(15);
            
            // Set the initial status.
            $loan->status = 'active'; // active, returned, overdue
            
            // Save the loan to the database.
            $loan->save();

           
            // We find the book and decrement its stock by 1.
             $book = Book::find($id);
             $book->stock--; 
             $book->save();
        }

        // Empty the cart (session) because the checkout is complete.
        // The user leaves the desk with empty hands (virtually) but with the books physically.
        session()->forget('cart');

        // Redirect to the catalog with a success message.
        return redirect()->route('books.catalog')->with('success', 'Loan processed successfully! Please return books within 15 days.');
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

    public function activeLoans(){
        $loans = \App\Loan::with(['user','book'])->orderBy('loan_date','desc')->paginate(10);

        return view('books.active_loans', compact('loans'));
    }

    public function returnBook($id){
        $loan = \App\Loan::find($id);

        if($loan){
            $loan->status = 'returned';
            $loan->save();

            $book = $loan->book;
            $book->stock++;
            $book->save();

            return redirect()->back()->with('success', 'Book tagged as returned.');
        
        }

        return redirect()->back()->with('error', "loan doen't found");
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
