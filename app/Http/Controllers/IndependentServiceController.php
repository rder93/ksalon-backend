<?php

namespace App\Http\Controllers;

use App\Models\IndepentService;
use Illuminate\Http\Request;
use App\Models\Independent;
use App\Models\Service;
use App\Models\User;

use DB;


class IndependentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $independent = User::find($request->user_id)->independent;
        return DB::table('independents_services')
                    ->join('services', 'independents_services.service_id', '=', 'services.id')
                    ->select('independents_services.id', 'independents_services.precio', 'independents_services.service_id','services.nombre as service_nombre', 'independents_services.created_at', 'independents_services.updated_at')
                    ->where('independents_services.independent_id', '=', $independent->id)
                    ->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function show(IndepentService $indepentService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function edit(IndepentService $indepentService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndepentService $indepentService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndepentService  $indepentService
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndepentService $indepentService)
    {
        //
    }
}
