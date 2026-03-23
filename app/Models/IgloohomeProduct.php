<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IgloohomeProduct extends Model
{

    protected $table = 'igloohome_products';

    protected $fillable = [

        'sku',
        'name_en',
        'name_jp',
        'color',
        'stock',
        'buy_price',
        'is_active',

    ];

    public function stockMovements()
    {
        return $this->hasMany(IgloohomeStockMovement::class,'product_id');
    }

}