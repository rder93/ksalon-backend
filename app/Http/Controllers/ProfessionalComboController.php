<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComboProfessional;
use App\Models\DetailProfessionalCombo;

class ProfessionalComboController extends Controller
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
        // dd($input);
        if ($input[0]) {
            $comboProfessional=ComboProfessional::create($input[0]);
            for ($i=0; $i < count($input[1]); $i++) { 
                DetailProfessionalCombo::create([
                    'combo_professional_id' => $comboProfessional['id'],
                    'professional_service_id' => $input[1][$i]['id'],                    
                ]);
            }
            // foreach ($input[1] as $detalleCombo) {
            //     DetailProfessionalCombo::create([
            //         'combo_professional_id' => $comboProfessional['id'],
            //         'professional_service_id' => $detalleCombo['id'],                    
            //     ]);
            // }
            return response()->json(
                [
                    'msj'=>'El Combo ha sido creado exitosamente.',
                    'combo' => $comboProfessional,
                    'code' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'msj'=>'Error al crear el combo',
                    'combo' => $comboProfessional,
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
        $comboProfessional=ComboProfessional::where('user_id','=',$id)->get();
        return response()->json($comboProfessional->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comboProfessional=ComboProfessional::findOrFail($id);
        return response()->json($comboProfessional->toArray());
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
        $comboProfessional = ComboProfessional::FindOrFail($id);
        $input = $request->all();
        $comboProfessional->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Combo ha sido actualizado exitosamente.',
                    'servicio' => $comboProfessional,
                    'code' => 1
                ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comboProfessional = ComboProfessional::FindOrFail($id);
        $comboProfessional->delete();
        return response()->json(
                [
                    'msj'=>'El Combo ha sido eliminado exitosamente.',
                    'producto' => $comboProfessional,
                    'code' => 1
                ]
        );
    }
}
