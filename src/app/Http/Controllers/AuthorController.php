<?php

namespace App\Http\Controllers;


use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function ListAuthor(){
        $response = AuthorService::ListAll();
        return response()->json(['success' => 'TRUE', 'message'=>'Listeleme Başarılı','data'=>$response]);
    }
}
