<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'transaction_code',
        'user_id',
        'front_image',
        'back_image',
        'left_image',
        'right_image',
        'quantity',
        'total_price',
        'status'
    ];
}
