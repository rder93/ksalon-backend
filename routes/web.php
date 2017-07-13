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

// Route::get('/', function () {
//     return response()->json(['hola']);
// });


// Route::resource('category', 'CategoryController');
// Route::get('/categories', 'CategoryController@index');

Route::post('/check', 'AuthController@check')->middleware('cors');
Route::resource('users', 'UsersController');
Route::resource('categories', 'CategoryController');
Route::resource('lounges', 'LoungeController');
Route::resource('professionals', 'ProfessionalController');
Route::resource('combos', 'ComboController');
Route::resource('services', 'ServiceController');
Route::resource('lounge.combos', 'ComboController');
Route::resource('lounge.services', 'ServiceController');

Route::resource('user.transaction', 'UsersController');

// Route::resource('lounge.service', 'LoungeController', ['except' => ['edit','update','destroy']]);