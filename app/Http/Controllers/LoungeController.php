<?php

namespace App\Http\Controllers;

use App\Models\Lounge;
use Illuminate\Http\Request;

use App\Models\LoungeService;

use DB;

class LoungeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lounge = Lounge::all();
        return response()->json($lounge);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lounge = new Lounge();

        return response()->json(
                [
                    "lounge" => $lounge,
                    "code" => 1
                ],
                200
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $lounge = Lounge::create(
                $request->all()
            );

            return response()->json(
                [
                    'mensaje'=>'El salon ha sido creado exitosamente.',
                    'lounge' => $lounge,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'mensaje'=>'Error al crear la categoria.',
                    'lounge' => $lounge,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $lounge= Lounge::where('user_id','=',$id)->get();
        
        return response()->json($lounge->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function edit($lounge_id)
    {
        $lounge =   DB::table('lounges')
                    ->select('lounges.id', 'lounges.nombre', 'lounges.descripcion', 'lounges.latitud', 'lounges.longitud', 'lounges.user_id', 'lounges.category_id', 'lounges.created_at', 'lounges.updated_at', 'categories.nombre as nombre_categoria', 'users.name as nombre_usuario')
                    ->join('categories', 'lounges.category_id', '=', 'categories.id')
                    ->join('users', 'lounges.user_id', '=', 'users.id')
                    ->where('lounges.id', $lounge_id)
                    ->first();

        return response()->json(
                [
                    "lounge" => $lounge,
                    "code" => 1
                ],
                200
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lounge = Lounge::FindOrFail($id);
        $input = $request->all();
        $lounge->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Salon ha sido actualizado exitosamente.',
                    'lounge' => $lounge,
                    'code' => 1
                ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lounge = Lounge::FindOrFail($id);
        $lounge->delete();
        return response()->json(
                [
                    'msj'=>'El Salon ha sido eliminado exitosamente.',
                    'salon' => $lounge,
                    'code' => 1
                ]
        );
    }

    public function all_lounge($lounge_id)
    {
        
        $lounge =   DB::table('lounges')
                    ->select('lounges.id', 'lounges.nombre', 'lounges.descripcion', 'lounges.latitud', 'lounges.longitud', 'lounges.user_id', 'lounges.category_id', 'lounges.created_at', 'lounges.updated_at', 'categories.nombre as nombre_categoria', 'users.name as nombre_usuario')
                    ->join('categories', 'lounges.category_id', '=', 'categories.id')
                    ->join('users', 'lounges.user_id', '=', 'users.id')
                    ->where('lounges.id', $lounge_id)
                    ->first();
        // dd($lounge->user_id);

        /* OBTENIENDO LOS COMENTARIOS DEL SALON */
        // $transactions = Lounge::find($lounge->user_id)->transactions;
        $transactions=null;
        $comments = [];
        if($transactions){
            for($i=0; $i < sizeof($transactions); $i++) {
                $comments[] = $transactions[$i]->score;
            }
        } else{
            $comments = [];
        }

        /* OBTENIENDO LAS FOTOS DEL SALON */
        $photos = Lounge::find($lounge->id)->photos;

        /* OBTENIENDO LOS SERVICIOS DEL SALON */
        $services = LoungeService::where('lounge_id',$lounge_id)
                    ->join('services', 'services.id', '=','lounges_services.service_id')
                    ->get();

        return response()->json(
                [
                    "lounge" => $lounge,
                    "services" => $services,
                    "comments" => $comments,
                    "photos" => $photos,
                    "code" => 1
                ],
                200
                );
            
    }


}
