<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailLoungeCombo;

class DetailLoungeComboController extends Controller
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
        if ($input) {
            $detailLoungeCombo=DetailLoungeCombo::create($input);
            return response()->json(
                [
                    'msj'=>'El Servicio ha sido agregado exitosamente.',
                    'combo' => $detailLoungeCombo,
                    'code' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'msj'=>'Error al agregar el servicio',
                    'combo' => $detailLoungeCombo,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailLoungeCombos= DetailLoungeCombo::where('combo_lounge_id','=',$id)->get();
        foreach ($detailLoungeCombos as $detailLoungeCombo) {
            $detailLoungeCombo['nombre']=$detailLoungeCombo->lounge_service->service->nombre;
        }
        
        return response()->json($detailLoungeCombos->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailLoungeCombo = DetailLoungeCombo::FindOrFail($id);
        $detailLoungeCombo->delete();
        return response()->json(
                [
                    'msj'=>'El Servicio ha sido eliminado exitosamente.',
                    'producto' => $detailLoungeCombo,
                    'code' => 1
                ]
        );
    }
}
