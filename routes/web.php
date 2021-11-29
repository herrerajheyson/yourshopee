<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
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
    return redirect(route('home'));
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\StoreController::class, 'index'])->name('home');
Route::get('/store/{category}', [App\Http\Controllers\StoreController::class, 'indexByCategory'])->name('bycategory');

Route::post('addtocar', 'App\Http\Controllers\CarController@addToShoppingCart')->name('addtocar');
Route::post('removefromcar', 'App\Http\Controllers\CarController@removeFromShoppingCart')->name('removefromcar');
Route::get('cleancart', 'App\Http\Controllers\CarController@cleanShoppingCart')->name('cleancart');
Route::get('showcar', [
    'as' => 'car.show',
    'uses' => 'App\Http\Controllers\CarController@show'
]);

Route::get('orders/myorders', [
    'as' => 'orders.myorders',
    'uses' => 'App\Http\Controllers\OrderController@myOrders'
]);
Route::post('orders', [
    'as' => 'orders.store',
    'uses' => 'App\Http\Controllers\OrderController@order'
]);
Route::get('orderfirststep', 'App\Http\Controllers\OrderController@orderFirstStep')->name('orderfirststep');
Route::get('orderfirststep/{order}', 'App\Http\Controllers\OrderController@getOrderFirstStep')->name('orderfirststep.option');

Route::post('register/order', 'App\Http\Controllers\Auth\RegisterController@registerFromOrder')->name('register.order');

Route::group(['middleware' => 'auth'], function () {
    //Maestro de Usuarios
    Route::resource('user', 'App\Http\Controllers\UserController');

    // Maestro de Categorías
    Route::resource('category', App\Http\Controllers\CategoryController::class);

    // Maestro de Productos
    Route::resource('products', App\Http\Controllers\ProductController::class);

    Route::resource('orders', OrderController::class)->except(['store', 'create', 'edit', 'update']);

    Route::post('payment', 'App\Http\Controllers\OrderController@payment')->name('payment');
    Route::get('payment/{reference}', 'App\Http\Controllers\OrderController@returnUrl')->name('payment.return_url');
    Route::get('payment/approved/{reference}', 'App\Http\Controllers\OrderController@paymentApproved')->name('payment.approved');

    Route::get('profile', [
        'as' => 'profile.edit',
        'uses' => 'App\Http\Controllers\ProfileController@edit'
    ]);

    Route::put('profile', [
        'as' => 'profile.update',
        'uses' => 'App\Http\Controllers\ProfileController@update'
    ]);

    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');

    Route::get('map', function () {
        return view('pages.maps');
    })->name('map');

    Route::get('icons', function () {
        return view('pages.icons');
    })->name('icons');

    Route::get('table-list', function () {
        return view('pages.tables');
    })->name('table');

    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
