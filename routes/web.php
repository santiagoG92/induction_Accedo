<?php

use App\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Auth::routes();
Route::get('/', [BookController::class, 'home'])->name('books.index');



// Route::get('/home', [HomeController::class, 'index'])
//     ->name('home');





Route::group(['middleware' =>['auth']],function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
//users rutas
    Route::group(['prefix' => 'users', 'middleware' => ['role:admin'],'controller'=> UserController::class],function(){
        // prefix' => 'users', 'middleware' => ['role:admin']
        Route::get('/',  'index')->name('users.index')->middleware('can:users.index');
        Route::get('/create',  'create')->name('users.create')->middleware('can:users.create');
        Route::post('/',  'store')->name('users.store')->middleware('can:users.store');
        Route::get('/{user}/edit',  'edit')->name('users.edit')->middleware('can:users.edit');
        Route::put('/{user}',  'update')->name('users.update')->middleware('can:users.update');
        Route::delete('/{user}',  'destroy')->name('users.destroy')->middleware('can:users.destroy');
    });

    //Books rutas
    Route::group(['prefix' => 'books','controller'=> BookController::class],function(){
        // prefix' => 'users', 'middleware' => ['role:admin']
        Route::get('/',  'index')->name('books.index')->middleware('can:books.index');
        Route::get('/create',  'create')->name('books.create')->middleware('can:books.create');
        Route::post('/',  'store')->name('books.store')->middleware('can:books.store');
        Route::get('/{user}/edit',  'edit')->name('books.edit')->middleware('can:books.edit');
        Route::put('/{user}',  'update')->name('books.update')->middleware('can:books.update');
        Route::delete('/{user}',  'destroy')->name('books.destroy')->middleware('can:books.destroy');
    });

    //Category rutas
    Route::group(['prefix' => 'categories', 'controller'=> CategoryController::class],function(){
        // prefix' => 'categories', 'middleware' => ['role:admin']
        Route::get('/',  'index')->name('categories.index')->middleware('can:categories.index');
        Route::get('/create',  'create')->name('categories.create')->middleware('can:categories.create');
        Route::post('/',  'store')->name('categories.store')->middleware('can:categories.store');
        Route::get('/{user}/edit',  'edit')->name('categories.edit')->middleware('can:categories.edit');
        Route::put('/{user}',  'update')->name('categories.update')->middleware('can:categories.update');
        Route::delete('/{user}',  'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
    });



});
