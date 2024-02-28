<?php

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

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::get('/info-city', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/states/{country} ', [App\Http\Controllers\HomeController::class, 'states'])->name('states');
    Route::get('/cities/{state}/{country} ', [App\Http\Controllers\HomeController::class, 'cities'])->name('cities');
    Route::get('/city/{city} ', [App\Http\Controllers\HomeController::class, 'city'])->name('city');
    Route::post('/city', [App\Http\Controllers\HomeController::class, 'store'])->name('city.store');
    Route::get('/mis-ciudades/{user}', [App\Http\Controllers\CityController::class, 'index'])->name('city.index');
    Route::delete('/mis-ciudades/{city} ', [App\Http\Controllers\CityController::class, 'destroy'])->name('city.destroy');

});
