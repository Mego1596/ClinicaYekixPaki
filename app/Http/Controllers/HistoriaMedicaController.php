<?php

namespace App\Http\Controllers;

use App\HistoriaMedica;
use Illuminate\Http\Request;

class HistoriaMedicaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $historia = new HistoriaMedica();
        $historia->descripcion = $request->descripcion;
        $historia->paciente_id = $request->paciente_id;
        $historia->save();
        return back()
                ->with('info','Creado Correctamente')
                ->with('tipo', 'success');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoriaMedica  $historiaMedica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $historiaMedica = HistoriaMedica::find($id);
        $historiaMedica->update($request->all());
        return back()
                ->with('info','Modificado Correctamente')
                ->with('tipo', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoriaMedica  $historiaMedica
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historiaMedica = HistoriaMedica::find($id);
        if($historiaMedica->delete()){
        return back()
            ->with('info','Eliminado Correctamente')
            ->with('tipo', 'success');
        }
    }
}
