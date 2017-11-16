<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishedProduct extends Model
{
    protected $fillable = ['product_name', 'product_type', 'price', 'image'];
}
