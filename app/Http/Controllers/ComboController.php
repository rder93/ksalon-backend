<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos = Combo::all();
        return response()->json($combos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $combo = new Combo();

        return response()->json(
                [
                    "combo" => $combo,
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
            $combo = Combo::create(
                $request->only(
                    'nombre',
                    'precio'
                )
            );

            return response()->json(
                [
                    'mensaje'=>'El combo ha sido creada exitosamente.',
                    'combo' => $combo,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'mensaje'=>'Error al crear el combo.',
                    'combo' => $combo,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function show(Combo $combo)
    {
        return response()->json($combo->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function edit(Combo $combo)
    {
        return response()->json(
                [
                    "combo" => $combo,
                    "code" => 1
                ],
                200
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Combo $combo)
    {
        try {
            $input = ([
                        'nombre' => $request['nombre']
                        'precio' => $request['precio']
                    ]);

            $combo->fill($input)->save();

            return response()->json(
                    [
                        'mensaje'=>'Combo actualizado correctamente',
                        'combo' => $combo,
                        'code' => 1
                    ]
                );
        } catch (Exception $e) {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combo $combo)
    {
        $combo->delete();
        return response()->json(
                [
                    'mensaje'=>'Combo eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
