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

Route::get('imagen_defecto', function(){
	return response()->json(['path' => 'no_avatar.jpg']);
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
Route::resource('professionalServices', 'ProfessionalServiceController');


Route::get('/transaccion/{id}','TransactionsController@show');
Route::get('verServicioProfesional/{id?}', 'LoungeServiceController@verServicioProfesional');

Route::post('updateProfessional','ProfessionalController@updateProfessional');

Route::post('/users/{id}', 'UsersController@update')->middleware('cors');

Route::post('/change_status/{id}', 'UsersController@change_status')->middleware('cors');
Route::get('/rols', 'RolController@index');
// Route::resource('independent.services','IndependentServiceController');

Route::get('/independent/{user_id}/services','IndependentServiceController@index');
Route::put('/independent/service/','IndependentServiceController@update');
