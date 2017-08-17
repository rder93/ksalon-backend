<?php

namespace App\Http\Controllers;

use App\Models\IndependentService;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;

use DB;


class IndependentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $services = IndependentService::all();
        return response()->json($services->toArray());

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

        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }

        $independent_service = new IndependentService;
        $independent_service->user_id = $request->id_user;
        $independent_service->service_id = $request->service_id;
        $independent_service->precio = $request->precio;
        $independent_service->descripcion = $request->descripcion;
        if($request->file("foto")){
            $independent_service->foto = $nombre;
        }


        if ($independent_service->save()) {
            return response()->json([
                'success' => true,
                'msj'     => 'Servicio creado exitosamente',
                'service_data' => $independent_service
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Error al crear servicio'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $services = IndependentService::where('user_id', $user_id)->get();
        foreach ($services as $service ) {
            $service['user_id'] = $service->user->name;
            $service['service_id'] = $service->service->nombre;
        }
        
        return response()->json($services->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function edit(IndependentService $independentService)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);

        }

        $independent_service = IndependentService::find($id);
        $independent_service->precio = $request->precio;
        $independent_service->descripcion = $request->descripcion;

        if($request->file("foto")){
            $independent_service->foto = $nombre;
        }
       
        
        if ($independent_service->save()) {
            return response()->json([
                'success'   => true,
                'msj'       => 'Servicio actualizado exitosamente',
                'user_data' => $independent_service
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Error al actualizar el servicio'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $independent_service = IndependentService::find($id);
        $independent_service ->delete();

        return response()->json([
            'success' => true,
            'msj'     => 'Servicio eliminado exitosamente'
        ]);
    }

    public function verServicioIndependiente($id)
    {
        $independentService = IndependentService::FindOrFail($id);
        $independentService['service_id']=$independentService->service->nombre;
        return response()->json($independentService->toArray());
    }

    public function buscarIndependentsServices(Request $request)
    {
        $salones = DB::table('independents_services')
            ->select('independents_services.id', 'user_id', 'users.name as nombre_salon', 'users.name as nombre_usuario', 'independents_services.service_id', 'independents_services.precio', 'independents_services.foto', 'independents_services.created_at', 'independents_services.updated_at', 'services.nombre as nombre_servicio', 'users.latitud', 'users.altitud')
            ->join('services', 'independents_services.service_id', '=', 'services.id')
            ->join('users', 'independents_services.user_id', '=', 'users.id')
            ->whereIn('service_id', $request->servicios)
            ->get()
            ->groupBy('user_id');

        $lounges = [];
        foreach ($salones as $key => $value) {
            // echo "clave: ". $key . "   --   Valor: ". $value . "<br><br>";
            $lounges[] = $value;
        }

        return response()->json($lounges);
    }
}