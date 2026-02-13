<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    
    protected $fillable = [
        'title','description', 'author_id', 'isbn', 'cover_url', 'stock', 'category_id'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    // We make it 'public static' so we can access this list from the Factory (BookFactory).
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
