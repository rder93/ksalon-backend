<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User;

use App\Models\Lounge;

use App\Models\Score;

use Validator;

use Illuminate\Validation\Rule;

use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('rol_id' , '!='  , 0)->get();
        return response()->json($users->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // return response()->json([
        //     'success' => true,
        //     'msj'     => 'Registro exitoso',
        //     'user_data' => $request->rol_id['id']
        // ]);

        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }
        
        $input    = $request->all();
        $name     = $request->name;
        $dni      = $request->dni;
        // $surname  = $request->surname;
        // $username = $request->username;
        $email    = $request->email;
        $password = $request->password;
        $rol_id   = $request->rol_id;
        $paypal   = $request->paypal;
        $passport = $request->passport;
        $latitud  = $request->latitud;
        $longitud = $request->longitud;

        if ($request['categoria']) {
            $rol_id=$request['categoria'];
        }
        // return response()->json([
        //         'success' => true,
        //         'msj'     => $request->all()
        //     ]);

        $rules = [
            'name'     => 'required|alpha',
            'email'    => 'required|unique:users',
            'password' => 'required',
            'dni'      => 'numeric',
            'passport' => 'alpha_num',
            'paypal'   => 'required',
            'rol_id'   => 'required'
        ];

        $messages = [
            'name.required'      => 'Ingresa tu nombre',
            'name.alpha'         => 'Tu nombre debe tener solo letras',
            'surname.required'   => 'Ingresa tu apellido',
            'surname.alpha'      => 'Tu apellido debe tener solo letras',
            'username.required'  => 'Ingresa tu nombre de usuario',
            'username.unique'    => 'Ya existe una cuenta asociada a este nombre de usuario',
            'email.required'     => 'Ingresa tu email',
            'email.unique'       => 'Ya existe una cuenta asociada a '.$email,
            'password.required'  => 'Ingresa tu contraseña',
            'rol_id.required'    => 'Ingresa tu tipo de perfil',
            'dni.numeric'        => 'El DNI debe tener solo numeros',
            'passport.alpha_num' => 'El pasaporte debe tener solo letras y numeros',
            'paypal.required'    => 'Ingresa tu correo de PayPal'
        ];

        $valide = Validator::make($input , $rules , $messages);

        if ($valide->fails()) {
            return response()->json([
                'success' => false,
                'user_data' => $input,
                'msj'     => $valide->errors()->first()
            ]);
        }else{

            $user = new User;
            $user->name = $name;
            // $user->surname = $surname;
            // $user->username = $username;
            $user->email    = $email;
            $user->dni      = $dni;
            $user->password =  bcrypt($password);
            $user->rol_id   = $rol_id;
            $user->status   = 1;
            $user->paypal   = $paypal;
            $user->passport = $passport;
            $user->latitud  = $latitud;
            $user->longitud = $longitud;

            if ($request->file("foto")) {
                $user->avatar= $nombre;
            }


            if ($user->save()) {  
                return response()->json([
                    'success' => true,
                    'msj'     => 'Registro exitoso',
                    'user_data' => $user,
                    'route' => 'register'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'msj'     => 'Error al registrar'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'user_data'  => $user
            ]);
        }else{

            return response()->json([
                'success' => false,
                'msj'     => 'Usuario no encontrado'
            ]);
        }
    }

    public function showSalones()
    {

        $salones = DB::table('users')
                    ->whereIn('rol_id', [1, 2])
                    ->get();

        // $salones = User::where('rol_id', [1,2])->get();
        return response()->json($salones->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::FindOrFail($id);

        if($user){
            $ratings = Score::where('user_to_id',$user->id)->get();

            if(count($ratings)>0){
                foreach($ratings as $rating){
                    $rating->creator = User::find($rating->user_id);
                }
            }
            $user->ratings = $ratings;
        }

        return response()->json($user->toArray());
    }

    public function editData(Request $request , $id){
        
        $input     = $request->all();
        $comission = $request->comission;
        $user      = User::find($id);

        if ($user) {
            if ($comission != '' && is_numeric($comission)) {
                $user->comission = $comission;
                $user->save();

                return response()->json([
                    'success' => true,
                    'msj'     => 'Usuario actualizado exitosamente'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'msj'     => 'La comision es requerida y debe tener solo numeros'
                ]);
            }
        } else{
            return response()->json([
                'success' => false,
                'msj'     => 'usuario no encontrado'
            ]);
        }
    }

    public function change_status($id)
    {
        $user = User::find($id);
        
        if ($user->status == 1) {
            $status = 0;
        }

        if ($user->status == 0) {
            $status = 1;
        }

        $user->status = $status;
        
        $user->save();


        if ($status == 1) {
            $n = 'activado';
        } elseif($status == 0) {
            $n = 'bloqueado';
        }

        return response()->json([
            'success' => true,
            'msj'     => 'Estado cambiado a '.$n.' ...',
            'data' => $user,
            'route' => 'change_status'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // return response()->json([
        //     'success' => false,
        //     'response' => $input
        // ]);

        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }


        $input          = $request->all();
        $user           = User::find($id);
        $name           = $request->name;
        $avatar         = $request->avatar;
        $email          = $request->email;
        $dni            = $request->dni;
        $passport       = $request->passport;
        $paypal         = $request->paypal;
        $status         = $request->status;

        $rules = [
            'name'     => 'required|alpha',
            'email'    => 'required|unique:users',
            'password' => 'required',
            'dni'      => 'numeric',
            'passport' => 'alpha_num',
            'paypal'   => 'required',
            'rol_id'   => 'required'
        ];

        $messages = [
            'name.required'      => 'Ingresa tu nombre',
            'name.alpha'         => 'Tu nombre debe tener solo letras',
            'surname.required'   => 'Ingresa tu apellido',
            'surname.alpha'      => 'Tu apellido debe tener solo letras',
            'username.required'  => 'Ingresa tu nombre de usuario',
            'username.unique'    => 'Ya existe una cuenta asociada a este nombre de usuario',
            'email.required'     => 'Ingresa tu email',
            'email.unique'       => 'Ya existe una cuenta asociada a '.$email,
            'password.required'  => 'Ingresa tu contraseña',
            'rol_id.required'    => 'Ingresa tu tipo de perfil',
            'dni.numeric'        => 'El DNI debe tener solo numeros',
            'passport.alpha_num' => 'El pasaporte debe tener solo letras y numeros',
            'paypal.required'    => 'Ingresa tu correo de PayPal'
        ];

        $valide = Validator::make($input , $rules , $messages);

        if ($valide->fails()) {
            return response()->json([
                'success' => false,
                'msj'     => $valide->errors()->first()
            ]);
        }else{

            $user->name         = $name;
            $user->email        = $email;
            $user->dni          = $dni;
            $user->paypal       = $paypal;
            $user->passport     = $passport;
           
            if ($request->file("foto")) {
                $user->avatar= $nombre;
            }

            if ($user->save()) {
                return response()->json([
                    'success'   => true,
                    'msj'       => 'Perfil actualizado exitosamente...',
                    'user_data' => $user
                ]);
            }else{
                return response()->json([
                    'success'   => true,
                    'msj'       => 'Error al actualizar'
                ]);
            }
        }
        // }
    }

    public function updateUser(Request $request)
    {
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }
        else{
            $nombre= $request['avatar'];
        }
        $usuario = User::FindOrFail($request['id']);
        $input = ([
                    'name' => $request['name'],
                    'avatar'   => $nombre,
                    'email' => $request['email'],
                    'dni' => $request['dni'],
                    'passport' => $request['passport'],
                    'paypal' => $request['paypal'],
                ]);
        $usuario->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Usuario ha sido actualizado exitosamente.',
                    'lounge' => $usuario,
                    'code' => 1
                ]
        );

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user          = User::find($id);
        // $images        = Image::where('user_id' , $id)->get();
        // $notifications = Notification::where('user_id' , $id)->orwhere('user_to_id' , $id)->get();
        // $ratings       = Rating::where('user_id' , $id)->orwhere('user_to_id' , $id)->get();
        // $cars          = Car::where('user_id' , $id)->get();
        // $tickets       = Ticket::where('user_id' , $id)->orwhere('user_to_id' , $id)->get();

        // if (count($images) > 0) {
        //     foreach ($images as $i) {
        //         unlink(base_path() . '/public/uploads/files/'.$i->name);
        //         $i->delete();
        //     }
        // }

        // if (count($notifications) > 0) {
        //     foreach ($notifications as $n) {
        //         $n->delete();
        //     }
        // }

        // if (count($ratings) > 0) {
        //     foreach ($ratings as $r) {
        //         $r->delete();
        //     }
        // }

        // if (count($cars) > 0) {
        //     foreach ($cars as $c) {
        //         $tr     = Transaction::where('car_id' , $c->id)->get();
        //         $im     = Image::where('car_id' , $c->id)->get();
        //         $tr_ra  = Transport_Rate::where('car_id' , $c->id)->get();
        //         $dri_ra = Driver_Rate::where('car_id' , $c->id)->get();
        //         $ren_ra = Renter_Rate::where('car_id' , $c->id)->get();

        //         if (count($tr) > 0) {
        //             foreach ($tr as $t) {
        //                 if ($t->buyer_id == $c->user_id) {
        //                     $t->buyer_id = null;
        //                 }else{
        //                     $t->seller_id = null;
        //                 }
        //                 $t->save();
        //             }
        //         }

        //         if (count($im) > 0) {
        //             foreach ($im as $i) {
        //                 unlink(base_path() . '/public/uploads/files/'.$i->name);
        //                 $i->delete();
        //             }
        //         }

        //         if (count($tr_ra) > 0) {
        //             foreach ($tr_ra as $t) {
        //                 $t->delete();
        //             }
        //         }

        //         if (count($dri_ra) > 0) {
        //             foreach ($dri_ra as $d) {
        //                 $d->delete();
        //             }
        //         }

        //         if (count($ren_ra) > 0) {
        //             foreach ($ren_ra as $r) {
        //                 $r->delete();
        //             }
        //         }
        //     }
        // }

        // if (count($tickets) > 0) {
        //     foreach ($tickets as $t) {
        //         $im = Image::where('ticket_id' , $t->id)->get();
        //         if (count($im) > 0) {
        //             foreach ($im as $i) {
        //                 unlink(base_path() . '/public/uploads/files/'.$i->name);
        //                 $i->delete();
        //             }
        //         }
        //         $im->delete();
        //     }
        // }

        $user->delete();

        return response()->json([
            'success' => true,
            'msj'     => 'Usuario eliminado exitosamente'
        ]);
    }
}
