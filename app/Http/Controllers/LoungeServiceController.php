<?php

namespace App\Http\Controllers;

use App\Models\LoungeService;
use App\Models\Lounge;
use Illuminate\Http\Request;

use DB;

class LoungeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loungeServices=LoungeService::all();
        return response()->json($loungeServices->toArray());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $input= $request->all();
            if ($request->file("foto")) {
                $aleatorio = str_random(6);
                $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
                $request->file("foto")->move('imagenes',$nombre);
            }else{
                $nombre='no_avatar.jpg';
            }

            $loungeService = LoungeService::create([
                'lounge_id' => $input['lounge_id'],
                'service_id' => $input['service_id'],
                'precio' => $input['precio'],
                'descripcion' => $input['descripcion'],
                'foto' => $nombre,
            ]);

            return response()->json(
                [
                    'msj'=>'El Servicio ha sido creado exitosamente.',
                    'lounge' => $loungeService,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'msj'=>'Error al crear el Producto.',
                    'lounge' => $loungeService,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoungeService  $loungeService
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loungeServices= LoungeService::where('lounge_id','=',$id)->get();
        foreach ($loungeServices as $loungeService) {
            $loungeService['nombre']=$loungeService->service->nombre;
        }
        return response()->json($loungeServices->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoungeService  $loungeService
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loungeService = LoungeService::FindOrFail($id);
        $loungeService['nombre']=$loungeService->service->nombre;
        return response()->json($loungeService->toArray());
    }
    

    public function verServicioProfesional($id)
    {
        $loungeService = LoungeService::FindOrFail($id);
        $loungeService['nombre']=$loungeService->service->nombre;
        return $loungeService;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoungeService  $loungeService
     * @return \Illuminate\Http\Response
     */

    public function updateService(Request $request)
    {
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }
        else{
            $nombre= $request['foto'];
        }
        $loungeService = LoungeService::FindOrFail($request['id']);
        $input = ([
                    'lounge_id' => $request['lounge_id'],
                    'service_id' => $request['service_id'],
                    'precio' => $request['precio'],
                    'foto' => $nombre,
                ]);
        $loungeService->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Servicio ha sido actualizado exitosamente.',
                    'lounge' => $loungeService,
                    'code' => 1
                ]
        );

    }

    public function update(Request $request, $id)
    {
        $loungeService = LoungeService::FindOrFail($id);
        $input = $request->all();
        $loungeService->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Producto ha sido actualizado exitosamente.',
                    'servicio' => $loungeService,
                    'code' => 1
                ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoungeService  $loungeService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loungeService = LoungeService::FindOrFail($id);
        $loungeService->delete();
        return response()->json(
                [
                    'msj'=>'El Servicio ha sido eliminado exitosamente.',
                    'producto' => $loungeService,
                    'code' => 1
                ]
        );
    }

    public function buscarLoungesServices(Request $request)
    {

        $salones = DB::table('lounges_services')
            ->select('lounges_services.id', 'lounge_id', 'lounges.nombre as nombre_salon', 'users.name as nombre_usuario', 'service_id', 'lounges_services.precio', 'lounges_services.foto', 'lounges.created_at', 'lounges.updated_at', 'services.nombre as nombre_servicio', 'lounges.latitud', 'lounges.altitud')
            ->join('lounges', 'lounges_services.lounge_id', '=', 'lounges.id')
            ->join('services', 'lounges_services.service_id', '=', 'services.id')
            ->join('users', 'lounges.user_id', '=', 'users.id')
            ->whereIn('service_id', $request->servicios)
            ->get()
            ->groupBy('lounge_id');

        $lounges = [];
        foreach ($salones as $key => $value) {
            // echo "clave: ". $key . "   --   Valor: ". $value . "<br><br>";
            $lounges[] = $value;
        }

        return response()->json($lounges);

        // return DB::table('lounges_services')
        //     ->select('id', 'lounge_id', 'service_id', 'precio', 'created_at', 'updated_at')
        //     ->whereIn('service_id', $request->servicios)
        //     ->groupBy('lounge_id')
        //     ->get();

        // $lounge = Lounge::all();
        // return response()->json($lounge);
    }
}
