<?php

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\Dashboard\DashboardSiswaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function (){
    return view('home');
});
Route::get('/about', function (){
    return view('about');
});

Route::group(["prefix" => "/book"], function(){
    Route::get('/all', [BookController::class, 'index']);
    Route::get('/detail/{book}', [BookController::class, 'show']); //detail
    Route::post('/add', [BookController::class, 'store']); //add data
    Route::get('/create', [BookController::class, 'create']); //create data
    Route::delete('/delete/{book}', [BookController::class, 'destroy']); //delete data
    Route::get('/edit/{book}', [BookController::class, 'edit']); //edit
    Route::post('/update/{book}', [BookController::class, 'update']); //update
});

Route::group(["prefix" => "/publisher"], function(){
    Route::get('/all', [PublisherController::class, 'index']);
    Route::get('/detail/{publisher}', [PublisherController::class, 'show']);
});

Route::group(["prefix"=>"/login"], function(){
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/authenticate', [LoginController::class, 'authenticate']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::group(["prefix"=>"/register"], function(){
    Route::get('/', [RegisterController::class,'index']);
    Route::post('/create', [RegisterController::class,'create']);
});

Route::group(["prefix"=>"/dashboard"], function(){
    Route::get('/home', function(){
        return view('dashboard.home');
    })->middleware('auth');

    Route::group(["prefix"=>"/book"], function(){
        Route::get('/all', [DashboardSiswaController::class, 'index'])->name('dashboard.book.all')->middleware('auth');
        Route::get('/detail/{book}', [DashboardSiswaController::class, 'show'])->middleware('auth');
        Route::post('/add', [BookController::class, 'store'])->middleware('auth'); 
        Route::get('/create', [BookController::class, 'create'])->middleware('auth'); 
        Route::delete('/delete/{book}', [BookController::class, 'destroy'])->middleware('auth'); 
        Route::get('/edit/{book}', [BookController::class, 'edit'])->middleware('auth'); 
        Route::post('/update/{book}', [BookController::class, 'update'])->middleware('auth'); 
    });
});
