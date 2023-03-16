<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;




Route::get('/testredis', function () {
    Redis::set('name',"baris");
    return Redis::get('name');
});

Route::get('/testrabbit', function () {
    \App\Jobs\Testrabbit::dispatch("a@a.com");
});
