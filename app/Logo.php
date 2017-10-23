<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = [
        'logo_name',
        'base_price',
    ];
}
