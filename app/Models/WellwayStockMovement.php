<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellwayStockMovement extends Model
{
    protected $table = 'wellway_stock_movements';

    protected $fillable = [
        'order_id',
        'product_id',
        'type',
        'qty',
        'movement_date',
        'requested_by',
        'shipped_by',
        'shipped_to',
        'shipped_on',
        'status',
        'tracking_number',
        'carrier',
        'reference_document',
        'stock_before',
        'stock_after',
        'note',
        'user_id',
    ];

    public function product()
    {
        return $this->belongsTo(WellwayProduct::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}