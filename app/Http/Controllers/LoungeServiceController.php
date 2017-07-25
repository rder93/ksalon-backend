<?php

namespace App\Http\Controllers;

use App\Models\LoungeService;
use Illuminate\Http\Request;

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
            $loungeService = LoungeService::create(
                $request->all()
            );

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
        $loungeService= LoungeService::where('lounge_id','=',$id)->firstOrFail();
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
}
