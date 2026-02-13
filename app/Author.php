<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name', 'email', 'biography', 'website', 'photo_url'
    ];
    
    public static $authors_picture = [
        'https://example.com/default-author.jpg', // Default author picture
        'https://example.com/another-author.jpg' // Another example picture
    ];


}
