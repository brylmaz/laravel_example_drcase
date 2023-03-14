<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::post('/CreateOrder', [OrderController::class, 'index']);
});
Route::fallback(function () {
    $response = [
      'success' => false,
      'message' => 'Lütfen Doğru paremetre ve uri girdiğinizden emin olun.'
    ];
    return response($response, 200)
        ->header('Content-Type', 'text/plain');
});
