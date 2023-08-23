<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', "App\Http\Controllers\AuthController@login");
Route::post('auth/register', "App\Http\Controllers\AuthController@register");

$CARRIERS_PREFIX = 'carriers';
$CITIES_PREFIX = 'citys';
$ROUTES_PREFIX = 'routes';
$BUSES_PREFIX = 'buses';
$PROVINCES_PREFIX = 'provinces';
Route::prefix($CARRIERS_PREFIX)->group(function () {
    Route::post('/store', "App\Http\Controllers\CarrierController@store");
    Route::get('/index', "App\Http\Controllers\CarrierController@index");
    Route::get('/show/{id}', "App\Http\Controllers\CarrierController@show");
    Route::put('/update/{id}', "App\Http\Controllers\CarrierController@update");
    Route::delete('/delete/{id}', "App\Http\Controllers\CarrierController@destroy");
});

Route::prefix($CITIES_PREFIX)->group(function () {
    Route::post('/store', "App\Http\Controllers\CityController@store");
    Route::get('/index', "App\Http\Controllers\CityController@index");
    Route::get('/show/{id}', "App\Http\Controllers\CityController@show");
    Route::put('/update/{id}', "App\Http\Controllers\CityController@update");
    Route::delete('/delete/{id}', "App\Http\Controllers\CityController@destroy");
});

Route::prefix($ROUTES_PREFIX)->group(function () {
    Route::post('/store', "App\Http\Controllers\RouteController@store");
    Route::get('/index', "App\Http\Controllers\RouteController@index");
    Route::get('/show/{id}', "App\Http\Controllers\RouteController@show");
    Route::put('/update/{id}', "App\Http\Controllers\RouteController@update");
    Route::delete('/delete/{id}', "App\Http\Controllers\RouteController@destroy");
    Route::put('/update-complete/{id}', "App\Http\Controllers\RouteController@updateComplete");
    Route::get('/incomplete', "App\Http\Controllers\RouteController@incompleteRoute");
});

Route::prefix($BUSES_PREFIX)->group(function () {
    Route::post('/store', "App\Http\Controllers\BusController@store");
    Route::get('/index', "App\Http\Controllers\BusController@index");
    Route::get('/show/{id}', "App\Http\Controllers\BusController@show");
    Route::put('/update/{id}', "App\Http\Controllers\BusController@update");
    Route::delete('/delete/{id}', "App\Http\Controllers\BusController@destroy");
});

Route::prefix($PROVINCES_PREFIX)->group(function () {
    Route::post('/store', "App\Http\Controllers\ProvinceController@store");
    Route::get('/index', "App\Http\Controllers\ProvinceController@index");
    Route::get('/show/{id}', "App\Http\Controllers\ProvinceController@show");
    Route::put('/update/{id}', "App\Http\Controllers\ProvinceController@update");
    Route::delete('/delete/{id}', "App\Http\Controllers\ProvinceController@destroy");
});

Route::get('/login', 'AuthController@login')->name('login');


