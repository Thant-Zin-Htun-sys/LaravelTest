<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
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

Route::get('/home', [UserController::class, 'home'])->middleware(['auth'])->name('users.home');
Route::get('/movie/{movie}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

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

Route::middleware(['auth'])->group(function () {
    Route::prefix('genres')->group(function () {
        Route::controller(GenreController::class)->group(function () {
            Route::get('/', 'index')->name('genres.index');
            Route::get('/genres_search', 'search')->name('genres.search');
            Route::get('/create', 'create')->name('genres.create');
            Route::post('/', 'store')->name('genres.store');
            Route::get('/{genre}', 'show')->name('genres.show');
            Route::get('/{genre}/edit', 'edit')->name('genres.edit');
            Route::put('/{genre}', 'update')->name('genres.update');
            Route::delete('/{genre}', 'destroy')->name('genres.destroy');
        });
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('actors')->group(function () {
        Route::controller(ActorController::class)->group(function () {
            Route::get('/', 'index')->name('actors.index');
            Route::get('/actors_search', 'search')->name('actors.search');
            Route::get('/create', 'create')->name('actors.create');
            Route::post('/', 'store')->name('actors.store');
            Route::get('/{actor}', 'show')->name('actors.show');
            Route::get('/{actor}/edit', 'edit')->name('actors.edit');
            Route::put('/{actor}', 'update')->name('actors.update');
            Route::delete('/{actor}', 'destroy')->name('actors.destroy');
        });
    });
});

require __DIR__ . '/auth.php';
