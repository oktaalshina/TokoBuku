<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BukuController ::class,'index'])->name('buku.index');
Route::get('/buku/create', [BukuController::class,'create'])->name('buku.create');
Route::post('/buku', [BukuController::class,'store'])->name('buku.store');
Route::delete('/buku/{id}', [BukuController::class,'destroy'])->name('buku.destroy');
Route::get('/buku/{id}', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');