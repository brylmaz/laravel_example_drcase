<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = ['name'];

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
    public static function allByCache(){
        $author = Cache::get('authors');
        if ($author == null){
            $c = Author::all();
            Cache::put('authors',json_encode($c));
            return $c;
        }
        return json_decode($author);
    }
}
