<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/check', 'AuthController@check')->middleware('cors');

Route::resource('users', 'UsersController');
Route::resource('categories', 'CategoryController');
Route::resource('lounges', 'LoungeController');
Route::resource('professionals', 'ProfessionalController');
Route::resource('combos', 'ComboController');
Route::resource('services', 'ServiceController');
Route::resource('lounge.combos', 'ComboController');
Route::resource('loungeServices', 'LoungeServiceController');
Route::resource('user.transaction', 'UsersController');
Route::resource('products', 'ProductsController');
Route::resource('tickets', 'TicketsController');
Route::resource('transactions','TransactionsController');
Route::resource('scores','ScoreController');

Route::get('/transaccion/{id}','TransactionsController@show');
Route::get('verServicioProfesional/{id?}', 'LoungeServiceController@verServicioProfesional');

Route::post('/users/{id}', 'UsersController@update')->middleware('cors');
Route::get('/rols', 'RolController@index');