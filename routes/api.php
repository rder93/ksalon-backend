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
Route::get('imagen_defecto2', function(){
	return response()->json(['path' => 'no_photo.png']);
});


Route::post('/check', 'AuthController@check')->middleware('cors');

Route::resource('users', 'UsersController');
Route::resource('categories', 'CategoryController');
Route::resource('lounges', 'LoungeController');
Route::resource('professionals', 'ProfessionalController');
Route::resource('combos', 'ComboController');
Route::resource('services', 'ServiceController');
Route::resource('loungeCombos', 'ComboLoungeController');
Route::resource('loungeServices', 'LoungeServiceController');
Route::resource('loungePhotos', 'LoungePhotoController');
Route::resource('user.transaction', 'UsersController');
Route::resource('products', 'ProductsController');
Route::resource('tickets', 'TicketsController');
Route::resource('transactions','TransactionsController');
Route::resource('scores','ScoreController');
Route::resource('certificates', 'CertificateController');
Route::resource('detailLoungeCombo', 'DetailLoungeComboController');
Route::resource('professionalCombos', 'ProfessionalComboController');
Route::resource('detailProfessionalCombo', 'DetailProfessionalComboController');


Route::get('/roles','RolController@roles');
// Route::get('/transactionsAdmin','TransactionsController@indexAdmin')->middleware('cors');

Route::get('/transaccion/{id}','TransactionsController@show');
Route::get('verServicioProfesional/{id?}', 'LoungeServiceController@verServicioProfesional');

Route::get('/showSalones/','UsersController@showSalones');

Route::post('updateProfessional','ProfessionalController@updateProfessional');
Route::post('updateCertificate','CertificateController@updateCertificate');
Route::post('updateUser','UsersController@updateUser');
Route::post('updateService','LoungeServiceController@updateService');
Route::post('updateProduct','ProductsController@updateProduct');

Route::post('/users/{id}', 'UsersController@update')->middleware('cors');

Route::post('/professionalCombos/{id}', 'ProfessionalComboController@update')->middleware('cors');

Route::post('/change_status/{id}', 'UsersController@change_status')->middleware('cors');
Route::get('/rols', 'RolController@index');

/*RUTAS PROFESIONAL INDEPENDIENTE*/
Route::get('/independent/services','IndependentServiceController@index');
Route::get('/independent/{user_id}/services','IndependentServiceController@show');
Route::post('/independent/services/','IndependentServiceController@store');
Route::post('/independent/service/{id}','IndependentServiceController@update');
Route::delete('/independent/service/{id}','IndependentServiceController@destroy');

Route::get('verServicioIndependiente/{id}', 'IndependentServiceController@verServicioIndependiente');

/*FIN RUTA PROFESIONAL INDEPENDIENTE*/


/* BUSCAR QUE LOUNGES REALIZA LOS SERVICIOS */
Route::get('/buscar_lounges_services', 'LoungeServiceController@buscarLoungesServices');
Route::get('/buscar_independents_services', 'IndependentServiceController@buscarIndependentsServices');

Route::post('/loungePhotos/{id}', 'LoungePhotoController@update')->middleware('cors');


// Para el pago con paypal
Route::get('/payment', 'PaypalController@payment');
Route::get('payment/status', 'PaypalController@paymentStatus');




/*Mensajes*/
Route::get('/user/{id}/messages', 'MessagesController@userMessages');
// Route::get('/user/{id}/messages', 'MessagesController@userMessages');
// Route::get('/user/{user_id}/messages/{user_to_id}','MessagesController@conversation');

Route::get('/user/{user_id}/seller/{user_to_id}/messages/{transaction_id}','MessagesController@conversation');
Route::get('/message','MessagesController@store');



/*Tickets*/
