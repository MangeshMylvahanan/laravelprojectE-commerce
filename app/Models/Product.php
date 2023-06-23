<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_price',
        'product_discount',
        'product_discountprice',
        'product_description',
        'product_image',
        'product_multi-images',
        'catagory',
        'sub_catagory',
        'is_trending',
    ];
}
