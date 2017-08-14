<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoungePhoto;

class LoungePhotoController extends Controller
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
        $input= $request->all();
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }else{
            $nombre='no_photo.png';
        }
        $loungephoto = LoungePhoto::create([
            'foto'   => $nombre,
            'lounge_id' => $input['lounge_id']
            ]);


        return response()->json(
            [
            'msj'=>'Se ha guardado la foto exitosamente',
            'loungephoto' => $loungephoto,
            'code' => 1
            ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loungephoto= LoungePhoto::all()->where('lounge_id', '=' , $id);
        return response()->json($loungephoto->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loungephoto= LoungePhoto::findOrFail($id);
        return response()->json($loungephoto->toArray());
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
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }

        $loungephoto = LoungePhoto::FindOrFail($id);
        $input = ([
                    'lounge_id' => $request['lounge_id']
                ]);
        if($request->file("foto")){
            $input['foto'] = $nombre;
        }
        $loungephoto->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'La foto ha sido actualizado exitosamente...',
                    'lounge' => $loungephoto,
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
        $loungephoto = LoungePhoto::FindOrFail($id);
        $loungephoto->delete();
        return response()->json(
                [
                    'mensaje'=>'Certificado eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
