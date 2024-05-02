<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/create', function() {
    return view('posts.create');
})->name('posts.create');

Route::get('/posts', [PostController::class, 'index'])->name('home');
Route::post('create', [PostController::class, 'store'])->name('create');
Route::get('show/{id}', [PostController::class, 'show'])->name('show');
Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
Route::put('update/{id}', [PostController::class, 'update'])->name('update');
Route::delete('delete/{id}', [PostController::class, 'destroy'])->name('delete');

Route::get('/register', function () {
    return view('register');
})->name('register');
