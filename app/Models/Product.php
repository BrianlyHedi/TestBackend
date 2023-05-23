<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id', 'name', 'price', 'image'
    ];

    protected $with = ['category_product'];

    public function category_product(){
        return $this->belongsTo(CategoryProduct::class,'product_category_id')->select(['id', 'name']);
    }

}
