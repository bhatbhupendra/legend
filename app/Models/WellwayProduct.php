<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellwayProduct extends Model
{
    protected $table = 'wellway_products';

    protected $fillable = [
        'sku',
        'name_en',
        'name_jp',
        'color',
        'hinge',
        'stock',
        'buy_price',
        'is_active',
    ];

    public function stockMovements()
    {
        return $this->hasMany(WellwayStockMovement::class, 'product_id');
    }
}