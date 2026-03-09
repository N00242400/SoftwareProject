<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('services', ServiceController::class);

Route::middleware('auth')->group(function () {

    // Favourites routes
    Route::resource('favourites', FavouriteController::class)
        ->only(['index', 'store', 'destroy']);

    // Reviews (only allowed actions)
    Route::resource('reviews', ReviewController::class)
        ->only(['store', 'edit', 'update', 'destroy']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';