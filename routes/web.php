<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
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

Route::prefix('movies')->group(function () {
    Route::controller(MovieController::class)->group(function() {
        Route::get('/', 'index')->name('movies.index');
        Route::get('/create', 'create')->name('movies.create');
        Route::post('/', 'store')->name('movies.store');
        Route::get('/{movie}', 'show')->name('movies.show');
        Route::get('/{id}/edit', 'edit')->name('movies.edit');
        Route::put('/{id}', 'update')->name('movies.update');
        Route::delete('/{id}', 'destroy')->name('movies.destroy');
    });

    Route::post('/{movie_id}/rate', [RatingController::class, 'store'])->name('movies.rate');
});
