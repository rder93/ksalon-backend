<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = new Service();

        return response()->json(
                [
                    "service" => $service,
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
            $service = Service::create(
                $request->only(
                    'nombre'
                )
            );

            $services = Service::all();
            return response()->json(
                [
                    'mensaje'=>'El servicio ha sido creado exitosamente.',
                    'services' => $services,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'mensaje'=>'Error al crear el servicio.',
                    'service' => $service,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return response()->json($service->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return response()->json(
                [
                    "service" => $service,
                    "code" => 1
                ],
                200
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        try {
            $input = ([
                'nombre' => $request->nombre
            ]);

            if ($service->fill($input)->save()){
                $services = Service::all();
                return response()->json(
                    [
                        'mensaje'=>'Servicio actualizado correctamente',
                        'services' => $services,
                        'code' => 1
                    ]
                );
            }        
        } catch (Exception $e) {
            return response()->json(
                [
                    'mensaje'=>'Error al actualizar el servicio.',
                    'code' => 0,
                    'error' => $e
                ]
            );
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        $services = Service::all();

        return response()->json(
                [
                    'services' => $services,
                    'mensaje'=>'Servicio eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
