<?php

namespace App\Http\Controllers;

use App\Models\Ratings;
use Illuminate\Http\Request;

use Validator;

use App\Models\Score;


class ScoreController extends Controller
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
        $input            = $request->all();
        $puntaje          = $request->stars;
        $comentario       = $request->comentario;
        $user_id          = $request->user_id;
        $user_to_id       = $request->user_to_id;
        $transaction_id   = $request->transaction_id;


        $rules = [
            'puntaje'           => 'required|integer',
            'comentario'        => 'required',
            'user_id'           => 'required|integer',
            'user_to_id'        => 'required|integer',
            'transaction_id'    => 'required|integer'
        ]; 

        $messages = [
            'puntaje.required'    => 'Selecciona las estrellas de puntuacion',
            'puntaje.integer'     => 'Error al enviar calificacion',
            'comentario.required' => 'Ingresa un comentario sobre tu experiencia' ,
            'user_id.required'    => 'Error al enviar calificacion',
            'user_to_id.required' => 'Error al enviar calificacion'
        ];

        $valide = Validator::make($input , $rules , $messages);


        if ($valide->fails()) {
            return response()->json([
                'success' => false,
                'msj'     => $valide->errors()->first()
    
            ]);
        }else{
            $score                 = new Score;
            $score->puntaje        = $request->puntaje;
            $score->comentario     = $request->comentario;
            $score->user_id        = $request->user_id;
            $score->user_to_id     = $request->user_to_id;
            $score->transaction_id = $request->transaction_id;
            $score->save();

        }

        if($score->save()){
            return response()->json([
                'success'   => true,
                'msj'       => 'Calificacion enviada exitosamente'
            ]);

        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Error al enviar calificacion'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function show(Ratings $ratings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function edit(Ratings $ratings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ratings $ratings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ratings $ratings)
    {
        //
    }
}
