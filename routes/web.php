<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

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


Auth::routes();
Route::get('/home', [BukuController::class, 'index'])->name('buku.index');
Route::get('/', [BukuController::class, 'indexPublic'])->name('buku.public.index');
Route::get('/bukus/{id}', [BukuController::class, 'showPublic'])->name('buku.public.show');

Route::middleware(['auth'])->group(function () {
    Route::resource('buku', BukuController::class);
});