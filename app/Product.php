<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_type',
        'product_name',
        'base_price',
        'gender_flag',
        'jersey_type'
    ];
}
