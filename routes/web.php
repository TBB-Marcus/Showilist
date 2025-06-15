<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;

Route::get('/', [TMDBController::class, 'getTopShows'])->name('home');

require __DIR__.'/auth.php';
