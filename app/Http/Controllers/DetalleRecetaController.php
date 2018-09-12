<?php

namespace App\Http\Controllers;

use App\DetalleReceta;
use Illuminate\Http\Request;

class DetalleRecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $detalles = DetalleReceta::paginate();
        return view('detalleReceta.index',compact('detalles','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('detalleReceta.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $numero = DetalleReceta::select('id')->max('id');
        $detalle = new DetalleReceta();
        $detalle->medicamento = $request->medicamento;
        $detalle->dosis = $request->dosis;
        $detalle->cantidad = $request->cantidad;
        $detalle->receta_id = $request->receta_id;
        $detalle->id        = $numero+2;
        $detalle->save();
        return redirect()->route('detalleReceta.index',$request->receta_id)->with('info','Detalle de Receta Guardada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetalleReceta  $detalleReceta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalles = DetalleReceta::find($id);
        return view('detalleReceta.show',compact('detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleReceta  $detalleReceta
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$id2)
    {   
        $detalles = DetalleReceta::find($id2);
        return view('detalleReceta.edit',compact('id','detalles','id2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleReceta  $detalleReceta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleReceta $detalleReceta)
    {
        $detalle = DetalleReceta::find($request->id);
        $detalle->medicamento = $request->medicamento;
        $detalle->dosis = $request->dosis;
        $detalle->cantidad = $request->cantidad;
        $detalle->receta_id = $request->receta_id;
        $detalle->save();
        return redirect()->route('detalleReceta.index',$request->receta_id)->with('info','Detalle de Receta Actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleReceta  $detalleReceta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalleReceta= DetalleReceta::find($id);
        $detalleReceta->delete();
        return back()->with('info','Eliminado Correctamente');
    }
}
