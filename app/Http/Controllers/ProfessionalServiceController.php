<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalService;
use Illuminate\Http\Request;

class ProfessionalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            $professionalService = ProfessionalService::create(
                $request->all()
            );

            return response()->json(
                [
                    'msj'=>'El Servicio ha sido creado exitosamente.',
                    'professional' => $professionalService,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'msj'=>'Error al crear el Producto.',
                    'professional' => $professionalService,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professionalServices= ProfessionalService::where('professional_id','=',$id)->get();
        foreach ($professionalServices as $professionalService) {
            $professionalService['nombre']=$professionalService->service->nombre;
        }
        return response()->json($professionalServices->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professionalService= ProfessionalService::findOrFail($id);
        $professionalService['nombre']=$professionalService->service->nombre;
        return response()->json($professionalService->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $professionalService = ProfessionalService::FindOrFail($id);
        $input = $request->all();
        $professionalService->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Servicio ha sido actualizado exitosamente.',
                    'servicio' => $professionalService,
                    'code' => 1
                ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professionalService = ProfessionalService::FindOrFail($id);
        $professionalService->delete();
        return response()->json(
                [
                    'msj'=>'El Servicio ha sido eliminado exitosamente.',
                    'producto' => $professionalService,
                    'code' => 1
                ]
        );
    }
}
