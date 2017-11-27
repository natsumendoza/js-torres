<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',

        'bag_front_image',

        'white_front_image',
        'white_back_image',
        'white_left_image',
        'white_right_image',
        'white_round_neck_image',
        'white_v_neck_image',
        'white_collar_image',

        'red_front_image',
        'red_back_image',
        'red_left_image',
        'red_right_image',
        'red_round_neck_image',
        'red_v_neck_image',
        'red_collar_image',

        'green_front_image',
        'green_back_image',
        'green_left_image',
        'green_right_image',
        'green_round_neck_image',
        'green_v_neck_image',
        'green_collar_image',

        'blue_front_image',
        'blue_back_image',
        'blue_left_image',
        'blue_right_image',
        'blue_round_neck_image',
        'blue_v_neck_image',
        'blue_collar_image'
    ];
}
