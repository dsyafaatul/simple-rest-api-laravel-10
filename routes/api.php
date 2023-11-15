<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/v1/posts/store", "App\Http\Controllers\api\\v1\PostsController@store");
Route::get("/v1/posts", "App\Http\Controllers\api\\v1\PostsController@index");
Route::get("v1/posts/{id}", "App\Http\Controllers\api\\v1\PostsController@show");
Route::post("v1/posts/update", "App\Http\Controllers\api\\v1\PostsController@update");
