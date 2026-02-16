<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 🏷️ The Shelf Label (Category Model)
 * 
 * This model organizes our library into sections (e.g., Science Fiction, History).
 * Without categories, finding a book would be like finding a needle in a haystack!
 */
class Category extends Model
{
    /**
     * 🛡️ The White List ($fillable)
     * 
     * We only allow the 'name' of the category to be mass-assigned.
     * This keeps our shelf labels clean and secure.
     */
    protected $fillable = ['name'];
}
