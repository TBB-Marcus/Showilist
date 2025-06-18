<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\WatchlistController;

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

// **** ROUTES PROTECTED BY AUTHENTICATION ****
Route::middleware('auth')->group(function() {

    Route::get('/watchlist', [WatchlistController::class, 'getWatchlist'])->name('watchlist');
    Route::post('/watchlist/create/{id}', [WatchlistController::class, 'createFavorite'])->name('watchlist.create');

});
// ********************************************



require __DIR__.'/auth.php';
