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
        $input= $request->all();
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }else{
            $nombre='no_avatar.jpg';
        }
        try{
            $professional = Professional::create([
                'nombre' => $request['nombre'],
                'foto'   => $nombre,
                'identificacion' => $request['identificacion'],
                'lounge_id' => $request['lounge_id']
            ]);



            return response()->json(
                [
                    'msj'=>'El profesional ha sido creado exitosamente.',
                    'profesional' => $professional,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'msj'=>'Error al crear el profesional independiente.',
                    'profesional' => $professional,
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
    public function show($id)
    {
        $professional= Professional::all()->where('lounge_id', '=' , $id);
        return response()->json($professional->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professional=Professional::findOrFail($id);
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

    public function updateProfessional(Request $request)
    {
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            $request->file("foto")->move('imagenes',$nombre);
        }
        else{
            $nombre= $request['foto'];
        }
        $professional = Professional::FindOrFail($request['id']);
        $input = ([
                    'nombre' => $request['nombre'],
                    'foto'   => $nombre,
                    'identificacion' => $request['identificacion'],
                    'lounge_id' => $request['lounge_id']
                ]);
        $professional->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Profesional ha sido actualizado exitosamente.',
                    'lounge' => $professional,
                    'code' => 1
                ]
        );

    }

    public function update(Request $request, $id)
    {
        $input= $request->all();
        dd($input);
        if ($request->file("foto")) {
            $aleatorio = str_random(6);
            $nombre = $aleatorio.'-'.$request->file("foto")->getClientOriginalName();
            dd($nombre);
            $request->file("foto")->move('imagenes',$nombre);
        }
        else{
            dd('otra cosa');
        }
        // $input = ([
        //             'nombre' => $request ['nombre'],
        //             'foto' => $request ['foto'],
        //             'direccion' => $request ['direccion'],
        //             'user_id' => $request ['user_id']
        //         ]);

        // $professional->fill($input)->save();

        // return response()->json(
        //         [
        //             'mensaje'=>'Prosional actualizado correctamente',
        //             'professional' => $professional,
        //             'code' => 1
        //         ]
        //     );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professional = Professional::FindOrFail($id);
        $professional->delete();
        return response()->json(
                [
                    'mensaje'=>'Profesional eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
