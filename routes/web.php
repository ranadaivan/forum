<?php

use Illuminate\Http\Request;

// Registration route (home page)
Route::get('/', function () {
    return view('register');
})->name('register');

// Route for handling registration form submission
Route::post('/', function (Request $request) {
    // Validate request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Store user data in session
    $request->session()->put('user', [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        // You might want to hash the password before storing it
        // 'password' => bcrypt($validatedData['password']),
    ]);

    // Redirect to login page
    return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
})->name('register.submit');

// Login route
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route for handling login form submission
Route::post('/login', function (Request $request) {
    // Retrieve user data from session
    $user = $request->session()->get('user');

    // Authenticate user (dummy logic, replace with actual authentication)
    if ($user && $user['email'] === $request->input('email') && $user['password'] === $request->input('password')) {
        // Redirect to welcome page upon successful login
        return redirect()->route('welcome');
    } else {
        // Redirect back to login page with error message
        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }
})->name('login.submit');

// Welcome page route (after successful login)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome')->middleware('auth');

// Profile route
Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

// Logout route
Route::post('/logout', function (Request $request) {
    // Clear user data from session
    $request->session()->forget('user');

    // Redirect to login page
    return redirect()->route('login')->with('success', 'Logged out successfully.');
})->name('logout');

