<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Your existing routes

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

// Registration route
Route::get('/register', function () {
    return view('register');
})->name('register');

// Route for handling registration form submission
Route::post('/register', function (\Illuminate\Http\Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create user using validated data
    $user = \App\Models\User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validatedData['password']),
    ]);

    // Redirect to login page after successful registration
    return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
})->name('register.submit');

// Login route
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route for handling login form submission
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.submit');

// Profile route
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// Route for handling profile display
Route::get('/profile', 'App\Http\Controllers\ProfileController@show')->name('profile.show');

// Logout route
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
