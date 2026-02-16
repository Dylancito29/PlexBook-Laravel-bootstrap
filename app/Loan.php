<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 🧾 LOAN MODEL ("The Receipt")
 * 
 * Represents a transaction between a User and a Book.
 * It tracks WHO borrowed WHAT, WHEN, and if they brought it back.
 */
class Loan extends Model

{
    /**
     * The attributes that are mass assignable.
     * We define which fields are allowed to be filled in automatically.
     */
    protected $fillable = [
        'user_id', 'book_id', 'loan_date', 'return_date', 'status'
    ];

    /**
     * RELATIONSHIP: The Borrower
     * A loan ALWAYS belongs to a single user.
     * Usage: $loan->user->name
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * RELATIONSHIP: The Item
     * A loan ALWAYS refers to a single book copy.
     * Usage: $loan->book->title
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
