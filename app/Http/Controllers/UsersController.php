<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User;

use App\Models\Lounge;

use App\Models\Score;

use Validator;

use Illuminate\Validation\Rule;


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
        $paypal    = $request->paypal;
        $password = $request->password;
        $latitud  = $request->latitud;
        $longitud  = $request->longitud;

        $rol_id   = $request->rol_id;
        if ($request['categoria']) {
            $rol_id=$request['categoria'];
        }
        // return response()->json([
        //         'success' => true,
        //         'msj'     => $request->all()
        //     ]);

        $rules = [
            'name'     => 'required|alpha',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
            // 'rol_id'   => 'required',
            'paypal'   => 'required|email',
            'latitud'  => 'required',
            'longitud'  => 'required'
        ];



        $messages = [
            'name.required'      => 'Indica tu nombre',
            'name.alpha'         => 'Tu nombre debe tener solo letras',
            'surname.required'   => 'Indica tu apellido',
            'surname.alpha'      => 'Tu apellido debe tener solo letras',
            'username.required'  => 'Indica tu nombre de usuario',
            'username.unique'    => 'Ya existe una cuenta asociada a este nombre de usuario',
            'email.required'     => 'Indica tu email',
            'email.unique'       => 'Ya existe una cuenta asociada a este email',
            'email.email'        => 'Indica un email válido',
            'paypal.required'    => 'Indica tu correo de paypal',
            'paypal.email'       => 'Indica un email de paypal válido',
            'password.required'  => 'Indica tu contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            // 'rol_id.required'    => 'Indica tipo de usuario que quieres ser',
            'latitud.required'   => 'Indica tu direccion en el mapa',
            'longitud.required'  => 'Indica tu direccion en el mapa'
        ];

        $valide = Validator::make($input , $rules , $messages);

        if ($valide->fails()) {
            return response()->json([
                'success' => false,
                'msj'     => $valide->errors()->first(),
                'rol'     => $rol_id
            ]);
        }else{

            if($rol_id == null || $rol_id == ''){
                return response()->json([
                    'success' => false,
                    'msj'     => 'Indica tipo de usuario que quieres ser'
                ]);
            }


            $user = new User;
            $user->name = $name;
            // $user->surname = $surname;
            // $user->username = $username;
            $user->email    = $email;
            $user->paypal   = $paypal;
            $user->dni      = $dni;
            $user->password = bcrypt($password);
            $user->latitud  = $latitud;
            $user->longitud = $longitud;

            $user->rol_id   = $rol_id;
            $user->status   = 1;
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

        $users = User::all();

        return response()->json([
            'success' => true,
            'msj'     => 'Estado cambiado a '.$n.'',
            'data' => $user,
            'users' => $users,
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


        $input = $request->all();


        // return response()->json([
        //     'success' => false,
        //     'response' => $input
        // ]);

        $input          = $request->all();
        $user           = User::find($id);
        $name           = $request->name;
        // $surname        = $request->surname;
        // $username       = $request->username;
        // $avatar         = $request->avatar;
        $email          = $request->email;
        // $comission      = $request->comission;
        $dni            = $request->dni;
        // $driver_license = $request->driver_license;
        // $passport       = $request->passport;
        // $insure         = $request->insure;
        // $paypal         = $request->paypal;
        // $healt_insure   = $request->healt_insure;
        // $img_dni        = $request->img_dni;
        // $img_lic        = $request->img_lic;
        // $img_insure     = $request->img_insure;
        // $img_healt      = $request->img_healt;
        // $destiny        = base_path() . '/public/uploads';
        // $admin          = $request->admin;
        $status         = $request->status;

        $rules = [
            'name'           => 'required_without:admin|alpha',
            // 'surname'        => 'required_without:admin|alpha',
            // 'username'       => ['required_without:admin' , Rule::unique('users')->ignore($user->username)],
            'email'          => 'required|email',
            'email'          => 'unique:users,email,'.$user->id,
            // 'email'          => ['required_without:admin' , Rule::unique('users')->ignore($user->email)],
            // 'comission'      => 'numeric',
            'dni'            => 'required_without:admin|numeric',
            // 'driver_license' => 'required_without:client,admin|',
            // 'insure'         => 'required_without:client,admin',
            // 'paypal'         => 'required_without:admin|email',
            // 'healt_insure'   => 'required_without:admin,renter',
        ];

        $messages = [
            'name.required_without'           => 'Ingresa tu nombre',
            'name.alpha'                      => 'Tu nombre debe tener solo letras',
            // 'surname.required_without'        => 'Ingresa tu apellido',
            // 'surname.alpha'                   => 'Tu apellido debe tener solo letras',
            // 'username.required_without'       => 'Ingresa tu nombre de usuario',
            // 'username.unique'                 => 'Ya existe una cuenta asociada a este nombre de usuario',
            'email.required'                  => 'Ingresa tu email',
            'email.unique'                    => 'Ya existe una cuenta asociada a este email',
            'email.email'                     => 'Tu email debe tener una estructura de email valida',
            // 'comission.required_wit'          => 'Ingresa la comision a descontar a este usuario (En porcentaje)',
            // 'comission.numeric'               => 'La comision a descontar debe tener solo numeros',
            'dni.required_without'            => 'Ingresa tu dni',
            'dni.numeric'                     => 'Tu dni debe tener solo numeros',
            // 'driver_license.required_without' => 'Ingresa tu numero de licencia de conducir',
            // 'insure.required_without'         => 'Ingresa el numero de tu seguro de auto',
            // 'paypal.required_without'         => 'Ingresa tu cuenta paypal',
            // 'paypal.email'                    => 'Tu cuenta paypal debe tener una estructura de email valida',
            // 'healt_insure.required_without'   => 'Ingresa el numero de tu seguro medico',
        ];

        $valide = Validator::make($input , $rules , $messages);

        if ($valide->fails()) {
            return response()->json([
                'success' => false,
                'msj'     => $valide->errors()->first()
            ]);
        }else{

            // if (isset($admin)) {
            //     if ($comission != null || $comission != '') {
            //         $user->comission = $comission;
            //     }
            //     if ($status != null || $status != '') {
            //         $user->status = $status;
            //     }

            //     if ($user->save()) {
            //         return response()->json([
            //             'success'   => true,
            //             'msj'       => 'Perfil actualizado exitosamente',
            //             'user_data' => $user
            //         ]);
            //     }else{
            //         return response()->json([
            //             'success'   => true,
            //             'msj'       => 'Error al actualizar'
            //         ]);
            //     }
            // }else{
                $user->name         = $name;
                // $user->surname      = $surname;
                // $user->username     = $username;
                $user->email        = $email;
                $user->dni          = $dni;
                // $user->paypal       = $paypal;

                if ($user->save()) {
                    return response()->json([
                        'success'   => true,
                        'msj'       => 'Perfil actualizado exitosamente',
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
            $nombre= $request['foto'];
        }
        $usuario = User::FindOrFail($request['id']);
        $input = ([
                    'name' => $request['name'],
                    'avatar'   => $nombre,
                    'email' => $request['email'],
                    'dni' => $request['dni'],
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
