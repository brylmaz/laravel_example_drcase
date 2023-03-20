<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['order_number','products','total_price','discount_amount','amount_to_be_paid','campain_info'];

    public function orderline(): HasMany
    {
        return $this->HasMany(Orderline::class,'order_id','id')->with('product');
    }

    public static function findByCache($orderNumber){
        $order = Cache::get('OrderNumber_'.$orderNumber);
        if ($order == null){
            $o = Order::with('orderline')->where('order_number',$orderNumber)->get();
            Cache::put('OrderNumber_'.$orderNumber,json_encode($o));

            return $o;
        }

        return json_decode($order);
    }
}
