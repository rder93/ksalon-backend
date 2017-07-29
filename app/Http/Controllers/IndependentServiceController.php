<?php

namespace App\Http\Controllers;

use App\Models\IndependentService;
use Illuminate\Http\Request;
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
    public function index($user_id)
    {

        $services = IndependentService::where('user_id', $user_id)->get();
        foreach ($services as $service ) {
            $service['user_id'] = $service->user->name;
            $service['service_id'] = $service->service->nombre;
        }
        
        return response()->json($services->toArray());

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
