<?php

use App\Http\Middleware\TenantConnection;
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


// System routes
Route::group(['prefix' => '/system', 'as' => 'system.'], function(){
    Auth::routes();

    Route::get('/', function(){
        return view('auth.login');
    });

    Route::group(['middleware' => 'auth:system'], function(){

        Route::get('home', function () {
            return view('system.home');
        })->name('home');

    });

});

// Tenant routes
Route::group(['prefix' => '/{environment}', 'as' => 'tenant.'], function(){
    Auth::routes();

    //dd($locale = Request::segment(1));

    Route::get('/', function(){
        return view('auth.login');
    });

    Route::group(['middleware' => ['auth:tenant']], function(){

        Route::get('home', function () {
            return view('tenant.home');
        })->name('home');

    });

});

/*
Route::group(['prefix' => '/{environment}', 'as' => 'tenant.'], function () {
    Auth::routes();

    Route::group(['middleware' => 'auth:tenant'], function(){
        Route::name('home')->get('home', function () {
            return view('tenant.home');
        });
        //Route::resource('categories', 'CategoryController');
    });
});
*/