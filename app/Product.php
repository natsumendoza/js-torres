<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_type',
        'product_name',
        'base_price',
        'front_image',
        'back_image',
        'left_image',
        'right_image'
    ];
}
