<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Movie routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('movies')->group(function () {
        Route::controller(MovieController::class)->group(function () {
            Route::get('/', 'index')->name('movies.index');
            Route::get('/create', 'create')->name('movies.create');
            Route::post('/', 'store')->name('movies.store');
            Route::get('/{movie}', 'show')->name('movies.show');
            Route::get('/{movie}/edit', 'edit')->name('movies.edit');
            Route::put('/{movie}', 'update')->name('movies.update');
            Route::delete('/{movie}', 'destroy')->name('movies.destroy');
        });

        Route::middleware('auth')->group(function () {
            Route::post('/{movie}/rate', [RatingController::class, 'store'])->name('movies.rate');
        });

    });
});

require __DIR__ . '/auth.php';
