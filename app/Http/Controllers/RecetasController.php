<?php

namespace App\Http\Controllers;

use App\Recetas;
use App\Events;
use App\Paciente;
use App\DetalleReceta;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Http\Requests\RecetaRequest;
class RecetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $recetas = Recetas::where('events_id', $id)->paginate();
        $event = Events::find($id);
        $paciente = Paciente::find($event->paciente_id);
        return view('receta.index',compact('recetas','id','paciente')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $evento   = Events::find($id);
        $paciente = Paciente::find($evento->paciente_id);
        json_decode($paciente);
        return view('receta.create',compact('id','paciente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecetaRequest $request)
    {
        $receta = new Recetas();
        $receta->events_id = $request->events_id;
        $receta->peso      = $request->peso;
        $receta->save();
        return redirect()->route('detalleReceta.create',['cita' => $request->events_id,'receta'=>$receta->id])->with('info','Receta Guardada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function show($id,$id2)
    {
        $evento = Events::find($id);
        $paciente = Paciente::find($evento->paciente_id);
        $receta = Recetas::find($id2);
        $edad= Carbon::parse($paciente->fechaNacimiento)->age;
        $fecha = substr($receta->created_at, 0,11);
        $newDate = date("d/m/Y", strtotime($fecha));
        $detalles = DetalleReceta::where('receta_id',$id2)->get();
        $pdf = PDF::loadView('receta.show',compact('paciente','receta','newDate','detalles','edad'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$id2)
    {
        $evento   = Events::find($id);
        $paciente = Paciente::find($evento->paciente_id);
        json_decode($paciente);
        $recetas  = Recetas::find($id2);
        return view('receta.edit',compact('id','recetas','paciente','id2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function update(RecetaRequest $request)
    {
        $receta = Recetas::find($request->id);
        $receta->peso = $request->peso;
        $receta->save();
        return redirect()->route('receta.index',$request->events_id)->with('info','Receta actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receta = Recetas::find($id);
        $receta->delete();
        return back()->with('info','Eliminado Correctamente');
    }
}
