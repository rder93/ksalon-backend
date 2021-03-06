<?php

namespace App\Http\Controllers;

use App\Models\ComboLounge;
use App\Models\DetailLoungeCombo;
use Illuminate\Http\Request;

class ComboLoungeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $input=$request->all();
        if ($input[0]) {
            $comboLounge=ComboLounge::create($input[0]);
            foreach ($input[1] as $detalleCombo) {
                DetailLoungeCombo::create([
                    'combo_lounge_id' => $comboLounge['id'],
                    'lounge_service_id' => $detalleCombo['id'],                    
                ]);
            }
            return response()->json(
                [
                    'msj'=>'El Combo ha sido creado exitosamente.',
                    'combo' => $comboLounge,
                    'code' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'msj'=>'Error al crear el combo',
                    'combo' => $comboLounge,
                    'code' => 0
                ]
            );
        }
        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComboLounge  $comboLounge
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comboLounges=ComboLounge::where('lounge_id','=',$id)->get();
        return response()->json($comboLounges->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComboLounge  $comboLounge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comboLounge=ComboLounge::findOrFail($id);
        return response()->json($comboLounge->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComboLounge  $comboLounge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comboLounge = ComboLounge::FindOrFail($id);
        $input = $request->all();
        $comboLounge->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Combo ha sido actualizado exitosamente.',
                    'servicio' => $comboLounge,
                    'code' => 1
                ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComboLounge  $comboLounge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comboLounge = ComboLounge::FindOrFail($id);
        $comboLounge->delete();
        return response()->json(
                [
                    'msj'=>'El Combo ha sido eliminado exitosamente.',
                    'producto' => $comboLounge,
                    'code' => 1
                ]
        );
    }
}
