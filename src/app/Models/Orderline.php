<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orderline extends Model
{
    use HasFactory;

    protected $table = 'orderline';



    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'id','order_id');
    }
}
