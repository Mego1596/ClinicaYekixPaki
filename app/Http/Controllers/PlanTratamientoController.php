<?php

namespace App\Http\Controllers;

use App\Plan_Tratamiento;
use Illuminate\Http\Request;

class PlanTratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('planTratamiento.index');
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
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Plan_Tratamiento $plan_Tratamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan_Tratamiento $plan_Tratamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan_Tratamiento $plan_Tratamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan_Tratamiento $plan_Tratamiento)
    {
        //
    }
}
