<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['title','list_price','stock_quantity'];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function authors(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
