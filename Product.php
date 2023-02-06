<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'sku',
        'category_id', 
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function thumbnails()
    {
        return $this->hasMany(Thumbnail::class);
    }
}
