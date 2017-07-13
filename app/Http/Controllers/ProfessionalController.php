<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professional = Professional::all();
        return response()->json($professional);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professional = new Professional();

        return response()->json(
                [
                    "professional" => $professional,
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
            $professional = Professional::create(
                $request->only(
                    'nombre',
                    'foto',
                    'direccion',
                    'user_id'
                )
            );

            return response()->json(
                [
                    'mensaje'=>'El profesional ha sido creado exitosamente.',
                    'profesional' => $profesional,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'mensaje'=>'Error al crear el profesional independiente.',
                    'profesional' => $profesional,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function show(Professional $professional)
    {
        return response()->json($professional->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function edit(Professional $professional)
    {
        return response()->json(
            [
                "professional" => $professional,
                "code" => 1
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professional $professional)
    {
        $input = ([
                    'nombre' => $request ['nombre'],
                    'foto' => $request ['foto'],
                    'direccion' => $request ['direccion'],
                    'user_id' => $request ['user_id']
                ]);

        $professional->fill($input)->save();

        return response()->json(
                [
                    'mensaje'=>'Prosional actualizado correctamente',
                    'professional' => $professional,
                    'code' => 1
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professional $professional)
    {
        $professional->delete();
        return response()->json(
                [
                    'mensaje'=>'Profesional eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
