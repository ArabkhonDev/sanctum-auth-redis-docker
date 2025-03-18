<?php

use App\Http\Controllers\PostApiController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'test';
});


Route::resources([
    'posts'=> PostController::class
]);

Route::middleware('basic.auth')->prefix('admin')->group(function () {
    // Route::post('/posts', [PostController::class, 'store']);
    Route::apiResources([
        'posts'=> PostApiController::class
    ]);
});