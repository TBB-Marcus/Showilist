<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;

Route::get('/', [TMDBController::class, 'getTopShows'])->name('home');



// **** ROUTES FOR AUTHENTICATION ****

Route::get('/auth', function() {
    return view('auth.auth');
})->name('auth');

Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');

// ***********************************

Route::get('/show/{id}', [TMDBController::class, 'getShowDetails'])->name('show');
Route::get('/search', function() {
    return view('search');
})->name('search');




require __DIR__.'/auth.php';
