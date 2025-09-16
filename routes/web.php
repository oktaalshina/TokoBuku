<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BukuController ::class,'index'])->name('buku.index');