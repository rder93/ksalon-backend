<?php

namespace App\Http\Controllers;

use App\Models\Lounge;
use Illuminate\Http\Request;

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
            $lounge = Category::create(
                $request->only(
                    'nombre',
                    'tipo',
                    'direccion',
                    'category_id'
                )
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
    public function show(Lounge $lounge)
    {
        return response()->json($lounge->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function edit(Lounge $lounge)
    {
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
    public function update(Request $request, Lounge $lounge)
    {
        $input = ([
                    'nombre' => $request ['nombre'],
                    'tipo' => $request ['tipo'],
                    'direccion' => $request ['direccion'],
                    'category_id' => $request ['category_id']
                ]);

        $lounge->fill($input)->save();

        return response()->json(
                [
                    'mensaje'=>'Salon actualizado correctamente',
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
    public function destroy(Lounge $lounge)
    {
        $lounge->delete();
        return response()->json(
                [
                    'mensaje'=>'Salon eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
