<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Score;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;


class AuthController extends Controller
{
    public function check(Request $request)
    {
		$validator = Validator::make($request->all(), [
		    'email' => 'required',
		    'password' => 'required'
		]);

		if (!$validator->fails()) {

			if (Auth::attempt(['email' => $request->email, 'password' => $request->password  ])) {
				$ratings = Score::where('user_to_id',Auth::user()->id)->get();

	            return response()->json(['status' => 'success', 'message' => 'Gracias por iniciar sesion.', 'auth_user' => Auth::user(), 'rol' => Auth::user()->rol_id,'ratings' => $ratings] );
	        } else {
	        	return response()->json(['status' => 'error', 'message' => 'Combinacion email / password incorrecta.']);
	        }

		} else {
			return response()->json($validator->errors());
	    	
        }
    	
    }


}