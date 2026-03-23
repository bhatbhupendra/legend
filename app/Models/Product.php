<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [

        'redirect_id',
        'sku',
        'name_en',
        'name_jp',
        'category',
        'description',
    ];
}