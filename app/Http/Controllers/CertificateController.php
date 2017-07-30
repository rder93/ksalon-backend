<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificateController extends Controller
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
        $certificate = Certificate::create([
            'nombre' => $request['nombre'],
            'foto'   => $nombre,
            'professional_id' => $request['professional_id']
            ]);


        return response()->json(
            [
            'msj'=>'El certificado ha sido creado exitosamente.',
            'profesional' => $certificate,
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
        $certificate= Certificate::all()->where('professional_id', '=' , $id);
        return response()->json($certificate->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate= Certificate::findOrFail($id);
        return response()->json($certificate->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function updateCertificate(Request $request)
    {
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }
        else{
            $nombre= $request['foto'];
        }
        $certificate = Certificate::FindOrFail($request['id']);
        $input = ([
                    'nombre' => $request['nombre'],
                    'foto'   => $nombre,
                    'professional_id' => $request['professional_id']
                ]);
        $certificate->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Certificado ha sido actualizado exitosamente.',
                    'lounge' => $certificate,
                    'code' => 1
                ]
        );
    }

    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificate = Certificate::FindOrFail($id);
        $certificate->delete();
        return response()->json(
                [
                    'mensaje'=>'Certificado eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
