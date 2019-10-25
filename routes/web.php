<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/daniel', 'DanielController@send')->name('daniel.send');

Route::middleware('auth')->group(function () {

Route::get('/products', 'ProductsController@index');
Route::get('/product/{id}', 'ProductsController@show');
Route::post('/product', 'ProductsController@create');
Route::put('/product/{id}', 'ProductsController@update');
Route::delete('/product/{id}', 'ProductsController@delete');

Route::get('/products-table', function () {
    return view('productstable');
});

Route::get('/add-product', function () {
    return view('addProduct');
});

Route::get('/edit-product/{id}', function ($id) {
    return view('editProduct',  compact('id'));
});

Route::get('/view-product/{id}', function ($id) {
    // dd($id);
    return view('viewProduct', compact('id'));
});


Route::get('/import', 'ImportController@index'); // localhost:8000/
Route::post('/uploadFile', 'ImportController@uploadFile');

});

Route::get('/email', 'ImportController@sendemail');
