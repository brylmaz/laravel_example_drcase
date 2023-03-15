<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['title','list_price','stock_quantity'];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function authors(): BelongsTo
    {
        return $this->belongsTo(Author::class,'author_id','id');
    }

    public static function findByCache($id){
        $product = Cache::get('product_id_'.$id);
        if ($product == null){
            $p = Product::with('authors')->find($id);
            Cache::put('product_id_'.$id,json_encode($p));
            return $p;
        }
        return json_decode($product);
    }


}
