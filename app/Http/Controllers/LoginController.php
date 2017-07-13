<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User;

use Validator;

class LoginController extends Controller
{
    public function authUser(Request $request){
    	
    	$input    = $request->all();
    	$email    = $request->email;
    	//$password = bcrypt($request->password);
        $password = $request->password;

    	$rules = [
    		'email'    => 'required|email',
    		'password' => 'required'
    	];


    	$messages = [
    		'email.required'    => 'Ingresa tu email',
    		'email.email'       => 'Tu email debe tener una estructura valida',
    		'password.required' => 'Ingresa tu contraseña'
    	];

    	$valide = Validator::make($input , $rules , $messages);

    	if ($valide->fails()) {
    		return response()->json([
    			'success' => false,
    			'msj'     => $valide->errors()->first()
    		]);
    	}else{

    		$user = User::where('email' , $email)->where('password' , $password)->first();
    		if ($user) {
    			if ($user->status != 1) {
    				return response()->json([
		    			'success' => false,
		    			'msj'     => 'Usuario inactivo'
		    		]);
    			}else{
    				return response()->json([
		    			'success'   => true,
		    			'msj'       => 'Validacion exitosa',
		    			'route'     => 'login',
		    			'user_data' => $user
		    		]);
    			}
    		}else{
    			return response()->json([
	    			'success' => false,
	    			'msj'     => 'El usuario no existe'
	    		]);
    		}
    	}
    }
}
