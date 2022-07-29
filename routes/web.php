<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TerminalController;
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

Route::get('/', [SearchController::class, 'home'])->name('home');
Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::resource('countries', CountryController::class);
Route::resource('countries.terminals', TerminalController::class)->shallow();

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
