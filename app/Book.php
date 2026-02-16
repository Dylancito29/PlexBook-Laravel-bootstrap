<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 📖 BOOK MODEL
 * 
 * Represents a physical book in our library.
 * This file tells Laravel how to interact with the 'books' table in the database.
 */
class Book extends Model
{
    
    /**
     * The attributes that are mass assignable.
     * We define which fields can be filled automatically (e.g. from a form request).
     */
    protected $fillable = [
        'title','description', 'author_id', 'isbn', 'cover_url', 'stock', 'category_id'
    ];
    
    /**
     * RELATIONSHIP: Category
     * A book belongs to ONE category (e.g. "Science Fiction").
     * Usage: $book->category->name
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * RELATIONSHIP: Author
     * A book is written by ONE author.
     * Usage: $book->author->name
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * 🖼️ Default Covers Repository
     * 
     * A static list of image URLs used by the Factory when creating fake books.
     * We make it 'public static' so we can access this list from anywhere easily.
     */
    public static $covers = [
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788419868497_01.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788411618915_7r0tq1napyeqabiz.png?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788418174070_8d1gp7kb3jqm0eph.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788466357302_6n23zammvjudrsvw.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788413622132_ythbirmfy3iwons9.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788419868497_01.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788411618915_7r0tq1napyeqabiz.png?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788418174070_8d1gp7kb3jqm0eph.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788466357302_6n23zammvjudrsvw.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788413622132_ythbirmfy3iwons9.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788419868497_01.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788411618915_7r0tq1napyeqabiz.png?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788418174070_8d1gp7kb3jqm0eph.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788466357302_6n23zammvjudrsvw.jpg?width=400&height=600&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9781526680600_wsok46uabocci82f.png?width=700&height=1050&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9786075276915_wp9fuxwdwohmuer9.jpg?width=700&height=1050&store=default&image-type=small_image',
       'https://www.crisol.com.pe/media/catalog/product/9/7/9788425451096_6w64vnhklsopxaob.jpg?width=700&height=1050&store=default&image-type=small_image',
    ];
}
