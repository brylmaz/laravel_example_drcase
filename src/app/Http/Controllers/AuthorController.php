<?php

namespace App\Http\Controllers;


use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/ListAuthor",
     *     @OA\Response(success="TRUE", message="Listeleme Başarılı",data="data")
     * )
     */
    public function ListAuthor(){
        $response = AuthorService::ListAll();
        return response()->json(['success' => 'TRUE', 'message'=>'Listeleme Başarılı','data'=>$response]);
    }
}
