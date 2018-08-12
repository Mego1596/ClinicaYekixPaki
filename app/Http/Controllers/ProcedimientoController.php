<?php

namespace App\Http\Controllers;

use App\Procedimiento;
use Illuminate\Http\Request;

class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedimientos = Procedimiento::paginate();
        return view('procedimiento.index', compact('procedimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procedimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $procedimiento = Procedimiento::create($request->all());
        return redirect()->route('procedimiento.edit',$procedimiento->id)->with('info','Proceso guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Procedimiento $procedimiento)
    {      
        return view('procedimiento.show', compact('procedimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $procedimiento = Procedimiento::find($id);
        return view('procedimiento.edit', compact('procedimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procedimiento $procedimiento)
    {
        $procedimiento->update($request->all());
        return redirect()->route('procedimiento.edit',$procedimiento->id)->with('info','Proceso actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedimiento $procedimiento)
    {
        $procedimiento->delete();
        return back()->with('info','Eliminado Correctamente');
    }
}
