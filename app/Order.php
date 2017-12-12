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
        'fabric_type',
        'print_type',
        'quantity',
        'description',
        'total_price',
        'status'
    ];
}
