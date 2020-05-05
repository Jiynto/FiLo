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
});

Auth::routes();
Route::resource('items', 'ItemController');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('itemrequests', 'ItemRequestController');
Route::get('itemrequests/create/{id}', 'ItemRequestController@create');
Route::post('itemrequests/store/{id}', 'ItemRequestController@store');
Route::post('items/filter', 'ItemController@filter');
Route::post('itemrequests/filter', 'ItemRequestController@filter');
