<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['order_number','products','total_price','discount_amount','amount_to_be_paid','campain_info'];

    public function orderline(): HasMany
    {
        return $this->HasMany(Orderline::class,'order_id','id');
    }
}
