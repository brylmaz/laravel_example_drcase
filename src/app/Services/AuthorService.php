<?php
namespace App\Services;


use App\Http\Resources\AuthorResource;
use App\Models\Author;


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
