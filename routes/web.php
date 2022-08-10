<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TerminalController;

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
Route::post('/search/personal-info', [SearchController::class, 'getPersonalInfo'])->name('personal.info');
Route::post('/search/book', [SearchController::class, 'book'])->name('book');

Route::resource('countries', CountryController::class);
Route::resource('countries.terminals', TerminalController::class)->shallow();

Route::resource('airplanes', AirplaneController::class);
Route::resource('flights', FlightController::class);

Route::resource('bookings', BookingController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
