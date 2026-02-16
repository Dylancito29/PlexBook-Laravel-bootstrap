<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Category;

/**
 * 📚 BooksController: The Head Librarian
 * 
 * This controller acts as the central brain of the library system.
 * It handles all interactions involving books, including:
 * - Adding new books to the shelves (Store)
 * - Checking books in and out (Loans/Returns)
 * - Managing the user's "backpack" (Cart)
 * - displaying the correct catalog to visitors.
 */
class BooksController extends Controller
{
    /**
     * 🚪 The Creation Room (View)
     * Displays the form to add a new book.
     */
    public function create(){
        return view('books.create');
    }

    /**
     * 📊 The Dashboard: The Librarian's Control Center
     * 
     * This function gathers vital statistics to show the administrator exactly what is happening in the library.
     */
    public function dashboard(){
        // Get the current logged-in user (The Administrator)
        $user = auth()->user();
        
        $activeLoansCount = 0;
        $pendingReturnsCount = 0;
        
        if($user){
             // 1. Count Active Loans: How many books are currently out of the library?
             $activeLoansCount = \App\Loan::where('user_id', $user->id)
                                        ->where('status', 'active')
                                        ->count();
            
             // 2. Count Pending Returns: How many books are due in the next 3 days?
             // This warns the admin if a rush of returns is expected.
             $pendingReturnsCount = \App\Loan::where('user_id', $user->id)
                                            ->where('status', 'active')
                                            ->whereDate('return_date', '<=', now()->addDays(3))
                                            ->count();
        }

        // 3. Featured Books: Select 3 random books to showcase.
        // Think of this as the "Staff Picks" display near the entrance.
        $featuredBooks = Book::inRandomOrder()->take(3)->get();
        
        // 4. Total Inventory: Count every single book record in the database.
        $totalBooks = Book::count();

        // Send all this data to the dashboard view to be displayed.
        return view('books.dashboard', compact('activeLoansCount', 'pendingReturnsCount', 'featuredBooks', 'totalBooks'));
    }
    
    /**
     * ⚡ Quick Add: Category (AJAX)
     * 
     * Handles the "Add Category" popup. It receives data from JavaScript,
     * checks if it's valid, saves it, and sends a JSON response back so the page doesn't reload.
     */
    public function storeCategory(Request $request) {
        // Validation: Ensure the name exists and isn't already taken.
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        // Return a JSON envelope (like a digital receipt) to the frontend.
        return response()->json([
            'success' => true,
            'category' => $category,
            'message' => 'Category added successfully!'
        ]);
    }

    /**
     * ⚡ Quick Add: Author (AJAX)
     * Identical logic to storeCategory, but for Authors.
     */
    public function storeAuthor(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:authors,name'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->save();

        return response()->json([
            'success' => true,
            'author' => $author,
            'message' => 'Author added successfully!'
        ]);
    }

    /**
     * 📥 The Receiving Dock: Add New Book
     * 
     * This method processes the form submission when an admin adds a new book to the inventory.
     * It strictly validates the incoming shipment (data) before placing it on the shelf (database).
     */
    public function store(Request $request){
        // 1. Quality Control (Validation)
        // We reject the form immediately if any rule is broken.
        $request->validate([
            'title'=>'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books,isbn', // ISBN must be unique globally
            'description'=>'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id', // Category must exist in our records
            'author_id' => 'required|exists:authors,id',       // Author must exist in our records
            'stock'=>'required|integer|min:0',                 // Cannot have negative stock
            'cover_url'=>'required|string|max:255'
        ]);
        
        // 2. Unpacking (Creating the Object)
        // We look for the book in the database using its ID.
        $book = new Book();
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->author_id = $request->author_id;
        $book->stock = $request->stock;
        $book->cover_url = $request->cover_url;
        
        // 3. Shelving (Saving)
        $book->save();
        
        return redirect()->back()->with('success','Book created successfully!');
    }

    /**
     * 🛒 Add to Cart (The Backpack)
     * 
     * This function lets a user pick a book off the shelf and put it in their temporary bag (session).
     * It simulates the moment you hold a book in a library before going to the checkout desk.
     */
    public function addToCart($id){
        // 1. The Search (Finding the Book)
        // We locate the specific book in the database.
        $book = Book::find($id);

        if(!$book){
            return redirect()->back()->with('error',"Book doesn't found.");
        }

        // 2. The Bag Check (Retrieving Session)
        // We check the user's "backpack" (session). If they don't have one, we give them an empty container [].
        $cart = session()->get('cart',[]);

        // 3. The Capacity Rule (Max 5 Books)
        // Analogy: You only have two hands. A user cannot carry more than 5 books total (Current Loans + Cart).
        
        $activeLoansCount = \App\Loan::where('user_id', auth()->id())
                                     ->where('status', 'active')
                                     ->count();
        
        $currentCartCount = count($cart);
        
        // Safety Check: Limit enforcement
        if(($activeLoansCount + $currentCartCount) >= 5 ){
             return redirect()->back()->with('error', 'You have reached the limit of 5 borrowed books (Active Loans + Cart). Please return some books first.');
        }

        // 4. The Duplicate Check
        // You cannot borrow two copies of the exact same book ID.
        if (isset($cart[$id])){
            return redirect()->back()->with('error','you already have this book in your list');
        }

        // 5. Placing Item in Bag
        // We store only the essential details in the session array.
        $cart[$id] = [
            'title' => $book->title,
            'quantity' => 1,
            'cover' => $book->cover_url, 
            'author' => optional($book->author)->name,
            'category' => optional($book->category)->name,
        ];
        
        // 6. Zipping the Bag (Saving to Session)
        session()->put('cart',$cart);

        return redirect()->back()->with('success','Book added to your borrow list.' );
    }

    /**
     * 🗑️ Remove from Cart (Put back on shelf)
     * Removes a specific item from the user's session cart.
     */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Book removed from lending list successfully!');
    }

    /**
     * 🛎️ The Checkout Desk (Process Loan)
     * 
     * The most critical action. It converts the temporary items in the cart
     * into permanent Loan Records in the database and reduces stock.
     */
    public function processLoan(Request $request)
    {
        $cart = session()->get('cart');
        
        // 1. Empty Hands Check
        if(!$cart) {
             return redirect()->back()->with('error', 'Your lending list is empty!');
        }

        // 2. ID Check (Authentication)
        // If we don't know who you are, you can't borrow books.
        if (!auth()->check()) {
             return redirect()->route('login')->with('error', 'Please login to process your loan.');
        }

        // 3. Final Limit Check
        // Double-check the limit right before stamping the due date.
        $activeLoansCount = \App\Loan::where('user_id', auth()->id())
                                     ->where('status', 'active')
                                     ->count();
        $cartCount = count($cart);

        if (($activeLoansCount + $cartCount) > 5) {
             return redirect()->back()->with('error', 'Loan limit exceeded! You cannot have more than 5 active loans in total (including your cart). Please return some books first.');
        }

        // 4. Processing Each Book
        foreach($cart as $id => $details) {
            
            // A. Create the Loan Ticket (Record)
            $loan = new \App\Loan();
            $loan->user_id = auth()->id();
            $loan->book_id = $id;
            $loan->loan_date = now();
            $loan->return_date = now()->addDays(15); // Standard 15-day loan policy
            $loan->status = 'active'; 
            $loan->save();

            // B. Adjust Inventory (Stockroom)
            // The physical copy is now gone, so we reduce the count.
             $book = Book::find($id);
             if($book && $book->stock > 0) {
                 $book->stock--; 
                 $book->save();
             }
        }

        // 5. Clear the desk (Empty Cart)
        session()->forget('cart');

        return redirect()->route('books.catalog')->with('success', 'Loan processed successfully! Please return books within 15 days.');
    }


    /**
     * 📖 The Catalog View
     * 
     * Determines what books to show on the shelves.
     * Note: This method handles both "Browsing" and "Searching".
     */
    public function catalog(Request $request){
        $categories = Category::all();
        $authors = Author::all();
        
        // Carousel: Always show the 10 newest arrivals.
        $carouselBooks = Book::latest()->take(10)->get(); 

        $query = $request->get('query'); 

        // 1. Search Logic
        if ($query) {
            // If the user is searching, filter the shelves.
            $books = Book::where('title', 'like', '%' . $query . '%')->paginate(5);
        } else {
            // Otherwise, show everything page by page.
            $books = Book::paginate(5);
        }

        // 2. Role Check (Admin vs User)
        // Admins see the "Management Catalog" (with Edit/Delete buttons).
        // Standard users see the "Public Catalog".
        if (auth()->check() && auth()->user()->isAdmin()) {
            return view('books.admin_catalog', compact('books','categories','authors','carouselBooks'));
        }
        
        return view('books.catalog', compact('books','categories', 'authors', 'carouselBooks'));
    }

    /**
     * ✏️ Update Book Details
     * 
     * Handles the corrections to a book's record (e.g., typos, new cover).
     */
    public function update(Request $request, Book $book){
        $request->validate([
            'title'=>'required|string|max:255',
            // Ignore the current book's ID when checking for unique ISBN
            'isbn' => 'required|string|max:255|unique:books,isbn,' . $book->id,
            'description'=>'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'stock'=>'required|integer|min:0',
            'cover_url'=>'required|string|max:255'
        ]);
        
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->author_id = $request->author_id;
        $book->stock = $request->stock;
        $book->cover_url = $request->cover_url;
        
        $book->save();

        return redirect()->back()->with('success','Book updated successfully!');
    }

    /**
     * 📋 Active Loans List (Admin Only)
     * Shows the admin a ledger of all books currently out in the wild.
     */
    public function activeLoans(){
        // Eager Loading (with user, with book) prevents the "N+1 Problem".
        // Instead of asking the database 10 times "Who is this user?", we ask once.
        $loans = \App\Loan::with(['user','book'])
                          ->orderBy('loan_date','desc')
                          ->paginate(10);

        return view('books.active_loans', compact('loans'));
    }

    /**
     * ↩️ Return Process (The Drop-off Box)
     * 
     * Handles the logic when a book is returned to the library.
     */
    public function returnBook($id){
        // 1. Find the Loan Ticket
        $loan = \App\Loan::with('book')->find($id);

        if(!$loan){
            return redirect()->back()->with('error', "Loan record not found.");
        }

        // 2. Double-Return Prevention
        // Prevents an accidental double-click from messing up the inventory count.
        if($loan->status == 'returned'){
            return redirect()->back()->with('error', "This book has already been returned.");
        }

        // 3. Close the Loan
        $loan->status = 'returned';
        $loan->save();

        // 4. Restock the Shelf
        // We verify the book still exists in our system, then add +1 to stock.
        if($loan->book){
            $loan->book->increment('stock');
            return redirect()->back()->with('success', 'Book successfully returned to inventory.');
        }

        return redirect()->back()->with('warning', "Loan marked as returned, but the associated book record was missing.");
    }

    /**
     * 📜 User History (My Loans)
     * Shows the logged-in user their own borrowing history.
     */
    public function myLoans(){
        $loans = \App\Loan::with('book.author')
            ->where('user_id', auth()->id())
            ->orderBy('created_at','desc')
            ->paginate(10);
        
        return view('books.my_loans', compact('loans'));
    }

    // --- Helper Routes for Views ---
    
    public function add(){
        $categories = \App\Category::all();
        $authors = \App\Author::all();
        return view('books.addBook', compact('categories', 'authors'));
    }

    public function updateView(){
        $books = Book::all();
        $categories = \App\Category::all();
        $authors = \App\Author::all();
        return view('books.updateBook', compact('books', 'categories', 'authors'));
    }

    public function delete(){
        $books = Book::all();
        return view('books.deleteBook', compact('books'));
    }

    public function destroy(Request $request){
        $Id = $request->input('book_id');
        $book = Book::find($Id); 
        if($book){
            $book->delete();
            return redirect()->back()->with('success','Book deleted successfully!');
        }else{
            return redirect()->back()->with('error','Book not found.');
        }
    }

    public function lendView() {
        return redirect()->route('books.catalog')->with('success', 'Please select a book to lend from the catalog.');
    }

    public function cart(){
        return view('books.cart');
    }
}
