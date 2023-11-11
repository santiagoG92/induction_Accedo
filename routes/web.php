<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http;

Auth::routes();
Route::get('/', [BookController::class, 'index']);



// Route::get('/home', [HomeController::class, 'index'])
//     ->name('home');




    
Route::group(['middleware' =>['auth']],function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'users', 'middleware' => ['role:admin']],function(){
        // prefix' => 'users', 'middleware' => ['role:admin']
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });



});