<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    protected $fillable = [
        'thumbnail',
        'product_id',
    ];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
