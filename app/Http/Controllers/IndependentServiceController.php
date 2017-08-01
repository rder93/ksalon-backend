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

        // $servicio = $request->id_service;


        // return response()->json([
        //     'success' => true,
        //     'msj'     => 'Servicio creado',
        //     'service_data' => $request->id_service
        // ]);

        $independent_service = new IndependentService;
        $independent_service->user_id = $request->id_user;
        $independent_service->service_id = $request->id_service['id'];
        $independent_service->precio = $request->precio;


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

        try {

            $independent_service = IndependentService::find($id);
            $independent_service->precio = $request->precio;
            
            if ($independent_service->save()) {
                return response()->json([
                        'success'   => true,
                        'msj'       => 'Servicio actualizado exitosamente',
                        'user_data' => $independent_service
                    ]);
            }

        } catch (Exception $e) {
            return response()->json(['msj' => $e]);
        }

        // return response()->json($this->obtenerServicios());
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

    private function obtenerServicios($user_id)
    {
        $services = IndependentService::where('user_id', $user_id)->get();
        foreach ($services as $service ) {
            $service['user_id'] = $service->user->name;
            $service['service_id'] = $service->service->nombre;
        }
        
        return response()->json([
                'success'   => true,
                'msj'       => 'Perfil actualizado exitosamente',
                'user_data' => $services
            ]);
    }
}

// $independent = User::find($request->user_id)->independent;
// return DB::table('independents_services')
//             ->join('services', 'independents_services.service_id', '=', 'services.id')
//             ->select('independents_services.id', 'independents_services.precio', 'independents_services.service_id','services.nombre as service_nombre', 'independents_services.created_at', 'independents_services.updated_at')
//             ->where('independents_services.independent_id', '=', $independent->id)
//             ->get();