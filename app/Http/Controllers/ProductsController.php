<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
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
        try{
            $lounge = Product::create(
                $request->all()
            );

            return response()->json(
                [
                    'msj'=>'El Producto ha sido creado exitosamente.',
                    'lounge' => $lounge,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'msj'=>'Error al crear el Producto.',
                    'lounge' => $lounge,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=Product::select('*')->where('lounge_id','=',$id)->get();
        return response()->json($products->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        return response()->json($product->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Product::FindOrFail($id);
        $input = $request->all();
        $producto->fill($input)->save();
        return response()->json(
                [
                    'msj'=>'El Producto ha sido actualizado exitosamente.',
                    'producto' => $producto,
                    'code' => 1
                ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Product::FindOrFail($id);
        $producto->delete();
        return response()->json(
                [
                    'msj'=>'El Producto ha sido eliminado exitosamente.',
                    'producto' => $producto,
                    'code' => 1
                ]
        );
    }
}
