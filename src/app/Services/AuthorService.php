<?php
namespace App\Services;



use App\Exceptions\ProductStockException;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\CampaignResource;
use App\Models\Author;
use App\Models\Campaign;
use Illuminate\Support\Facades\Cache;

class AuthorService
{
    protected $author;
    public function __construct(Author $author)
    {
        $this->$author = $author;
    }

    public static function ListAll(){

        return AuthorResource::collection(Author::allByCache());

    }

}
