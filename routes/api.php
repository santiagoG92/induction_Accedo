<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthUserAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'users','controller'=>UserController::class],function(){
Route::get('/','index');
Route::get('/{user}','show');
Route::post('/','store');
Route::put('/{user}','update');
Route::delete('/{user}','destroy');
});
Route::group(['prefix'=>'authors','controller'=>AuthorController::class],function(){
Route::get('/','index');
Route::get('/{author}','show');
Route::post('/','store');
Route::put('/{author}','update');
Route::delete('/{author}','destroy');
});
Route::post('/login',[AuthUserAPIController::class,'login']);


