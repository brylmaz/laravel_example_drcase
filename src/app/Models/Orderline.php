<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orderline extends Model
{
    use HasFactory;

    protected $table = 'orderline';



    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'id','order_id');
    }
    public function product(): BelongsTo
    {
        return $this->BelongsTo(Product::class,'product_id','id')->with('categories','authors');
    }
}
