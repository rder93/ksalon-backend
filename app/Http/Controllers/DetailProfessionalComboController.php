<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailProfessionalCombo;

class DetailProfessionalComboController extends Controller
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
            $detailProfessionalCombo=DetailProfessionalCombo::create($input);
            return response()->json(
                [
                    'msj'=>'El Servicio ha sido agregado exitosamente.',
                    'combo' => $detailProfessionalCombo,
                    'code' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'msj'=>'Error al agregar el servicio',
                    'combo' => $detailProfessionalCombo,
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
        $detailProfessionalCombos= DetailProfessionalCombo::where('combo_professional_id','=',$id)->get();
        foreach ($detailProfessionalCombos as $detailProfessionalCombo) {
            $detailProfessionalCombo['nombre']=$detailProfessionalCombo->professional_service->service->nombre;
        }
        
        return response()->json($detailProfessionalCombos->toArray());
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
        $detailProfessionalCombo = DetailProfessionalCombo::FindOrFail($id);
        $detailProfessionalCombo->delete();
        return response()->json(
                [
                    'msj'=>'El Servicio ha sido eliminado exitosamente.',
                    'producto' => $detailProfessionalCombo,
                    'code' => 1
                ]
        );
    }
}
