<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComboProfessional;
use App\Models\DetailProfessionalCombo;
use App\Models\Service;

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

        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }

        $input=$request->all();

        $myindex = "user_id";
        $index = 0;
        foreach ($input as $k => $v) {
            if ($k == $myindex) {
                $myindex=$index;
            }
            $index=$index+1;
        }

        if ($input) {

            $comboProfessional = new ComboProfessional;
            $comboProfessional->descripcion = $input['descripcion'];
            $comboProfessional->precio = $input['precio'];
            $comboProfessional->user_id = $input['user_id'];
            if($request->file("foto")){
                $comboProfessional->foto = $nombre;
            }

            $comboProfessional->save();

            for ($i=0; $i < $myindex; $i++) { 
                DetailProfessionalCombo::create([
                    'combo_professional_id' => $comboProfessional['id'],
                    'professional_service_id' => $input[$i],                    
                ]);
            }

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

        // dd($request->all());

        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }
        $comboData = [];
        
        $comboProfessional = ComboProfessional::FindOrFail($id);
        $input = $request->all();

        $myindex = "id";
        $index = 0;
        foreach ($input as $k => $v) {
            if ($k == $myindex) {
                $myindex=$index;
            }
            $index=$index+1;
        }

        $comboProfessional->descripcion = $input['descripcion'];
        $comboProfessional->precio = $input['precio'];
        if($request->file("foto")){
            $comboProfessional->foto = $nombre;
        }

        if($comboProfessional->save()){
            for ($i=0; $i < $myindex; $i++) { 
                DetailProfessionalCombo::create([
                    'combo_professional_id' => $comboProfessional['id'],
                    'professional_service_id' => $input[$i],                    
                ]);
            }
            return response()->json([
                'msj'=>'El Combo ha sido actualizado exitosamente',
                'servicio' => $comboProfessional,
                'code' => 1
            ]);
        }else{
            return response()->json([
                'msj'=>'Ocurrio un error',
                'servicio' => $comboProfessional,
                'code' => 0
            ]);
        }

        
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
