<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->group(function(){
    Route::resource(
        'users',
        \App\Http\Controllers\Admin\UserController::class
    );
    Route::resource(
        'genres',
        \App\Http\Controllers\Admin\GenreController::class
    );
    Route::resource(
        'tracks',
        \App\Http\Controllers\Admin\TracksController::class
    );
    Route::resource(
        'playlists',
        \App\Http\Controllers\Admin\PlaylistsController::class
    );
});
require __DIR__.'/auth.php';

Route::resource('/admin/users',
    \App\Http\Controllers\Admin\UserController::class);
Route::resource('/admin/genres',
    \App\Http\Controllers\Admin\GenreController::class);
Route::resource('/admin/tracks',
    \App\Http\Controllers\Admin\TracksController::class);
Route::resource('/admin/playlists',
    \App\Http\Controllers\Admin\PlaylistsController::class);

