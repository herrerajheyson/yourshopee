<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('categories_selector', 'App\Http\Controllers\CategoryController@categoriesSelector');
Route::put('updatecar', 'App\Http\Controllers\CarController@updateShoppingCartQuantity')->name('updatecar');
