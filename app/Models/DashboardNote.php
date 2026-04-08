<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardNote extends Model
{
    protected $fillable = [
        'note',
        'user_id',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}