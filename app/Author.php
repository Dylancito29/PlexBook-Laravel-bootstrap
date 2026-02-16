<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * ✍️  The Creator (Author Model)
 * 
 * This model represents the writers of the books in our library.
 * Think of it as the "Biography Card" attached to each book.
 */
class Author extends Model
{
    /**
     * 🛡️ The White List ($fillable)
     * 
     * These are the only personal details we allow to be mass-assigned.
     * It prevents someone from sneaking in unwanted data.
     */
    protected $fillable = [
        'name', 'email', 'biography', 'website', 'photo_url'
    ];
    
    /**
     * 🖼️ The Portrait Gallery
     * 
     * A static collection of default author images.
     * Useful when we don't have a real photo of the author.
     */
    public static $authors_picture = [
        'https://example.com/default-author.jpg', // Default author picture
        'https://example.com/another-author.jpg' // Another example picture
    ];


}
