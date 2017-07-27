<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalService;
use Illuminate\Http\Request;
use App\Http\Controllers\DB;

class ProfessionalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professional_services = ProfessionalService::all();
        return response()->json($professional_services);
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
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professional_services = ProfessionalService::where('professional_id', $id)->get();
        return response()->json($professional_services->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfessionalService $professionalService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfessionalService $professionalService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfessionalService  $professionalService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalService $professionalService)
    {
        //
    }
}
