<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shops::all();
        return response()->json($shops->toArray());
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
        $shop = Shop::create([
            'nombre' => $request ['nombre'],
        ]);

        return response()->json(
                [
                    'shop' => $shop, 
                    "code"=> 1
                ],
                200
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        // $Shop = Shop::find($id);
        return response()->json(
                [
                    "shop" => $shop,
                    "code" => 1
                ],
                200
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return response()->json(
                [
                    "shop" => $shop,
                    "code" => 1
                ],
                200
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $input = ([
                    'nombre' => $request ['nombre']
                ]);

        $shop->fill($input)->save();

        return response()->json(
                [
                    'mensaje'=>'Shop actualizado correctamente',
                    'shop' => $shop,
                    'code' => 1
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return response()->json(
                [
                    'mensaje'=>'Shop eliminado correctamente',
                    'code' => 1
                ]
            );
    }
}
