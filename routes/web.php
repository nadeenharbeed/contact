<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Models\City;
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
});
 Route ::prefix('dash/admin')->group(function(){
 Route :: view('/','dashboard.parent')->name('footer');
 Route :: view('temp','dashboard.parent');
Route::resource('countries',CountryController::class);
Route::post('countries-update/{id}',[CountryController::class,'update'])->name('countries-update');
Route::resource('cities',CityController::class);
Route::post('cities-update/{id}',[CityController::class,'update'])->name('cities-update');
Route::resource('contacts',ContactController::class);
Route::post('contacts-update/{id}',[ContactController::class,'update'])->name('contacts-update');
 });

