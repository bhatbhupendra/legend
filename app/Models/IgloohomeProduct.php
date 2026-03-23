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
        'buy_price',
        'is_active',

    ];

    public function stockMovements()
    {
        return $this->hasMany(IgloohomeStockMovement::class,'product_id');
    }

    public function getCurrentStockAttribute(){
        $stockIn = $this->stockMovements()
            ->where('type', 'in')
            ->sum('qty');

        $stockOut = $this->stockMovements()
            ->where('type', 'out')
            ->sum('qty');

        return $stockIn - $stockOut;
    }

}