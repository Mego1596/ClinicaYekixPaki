<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Procedimiento;
use App\Events;
use App\Paciente;
use Calendar;
use Validator;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::paginate();  
        return view('paciente.index', compact("pacientes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente = new Paciente();
        $paciente->nombre1 = $request->nombre;
        if($paciente->save()){

         return redirect()->route('paciente.index',$paciente->id)->with('info','Proceso guardado con exito');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {

        return view('paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        return view('paciente.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        return redirect()->route('paciente.edit',$paciente->id)->with('info','Proceso actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return back()->with('info','Eliminado Correctamente');
    }

    public function agendar(Paciente $paciente)
    {
        $procedimiento = Procedimiento::pluck('nombre', 'id')->toArray();

        $events = Events::select('id','paciente_id','start_date','end_date','procedimiento_id','descripcion')->where('paciente_id',$paciente->id)->get();
        $event_list= [];
        foreach ($events as $key => $event) {
            $proceso = Procedimiento::find($event->procedimiento_id);
            $paciente = Paciente::find($event->paciente_id);
            //poner aqui el paciente asociado a la cita
            $event_list[] =Calendar::event(
                $paciente->nombre1,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date),
                $event->id,
                [
                'color' => $proceso->color,
                'descripcion' => $event->descripcion,
                'textColor' => $event->textcolor,
                'procedimiento' => $proceso->id,
                ]
            );
        }
        
        

        $calendar_details = Calendar::addEvents($event_list)->setOptions([
            'firstDay' => 1,
            'editable' => true,
            'themeSystem'=>'bootstrap4',
            'locale' => 'es',
            'header' => array(
                'left' => 'prev,next today', 
                'center' => 'title', 
                'right' => 'month,agendaWeek,agendaDay'
                )
            ])->setCallbacks([
            'dayClick' => 'function(date,jsEvent,view){
                    $("#btnAgregar").prop("disabled",false);
                    $("#btnEliminar").prop("disabled",true);
                    $("#btnModificar").prop("disabled",true);
                    $("#tit").hide();
                    $("#txtTitulo").hide();
                    limpiarFormulario();
                    $("#txtFecha").val(date.format());
                    $("#exampleModal").modal();
                }',
            'eventClick' => 'function(calEvent,jsEvent,view){
                    $("#btnAgregar").prop("disabled",true);
                    $("#btnEliminar").prop("disabled",false);
                    $("#btnModificar").prop("disabled",false);
                    $("#txtDescripcion").val(calEvent.descripcion);
                    $("#txtTitulo").val(calEvent.title);
                    $("#txtID").val(calEvent.id);
                    $("#txtColor").val(calEvent.color);
                    FechaHora= calEvent.start._i.split("T");
                    horaInicio=FechaHora[1].split("+");
                    FechaHora2= calEvent.end._i.split("T");
                    horaFin=FechaHora2[1].split("+");
                    $("#txtFecha").val(FechaHora[0]);
                    $("#start_date").val(horaInicio[0]);
                    $("#end_date").val(horaFin[0]);
                    $("#procedimiento_id").val(calEvent.procedimiento);
                    $("#exampleModal").modal();     
                 }',

            'eventDrop' => 'function(calEvent,jsEvent,view){
                    $("#txtID").val(calEvent.id);
                    $("#txtTitulo").val(calEvent.title);
                    $("#txtColor").val(calEvent.color);
                    $("#txtDescripcion").val(calEvent.descripcion);
                    var fechaHora   = calEvent.start.format().split("T");
                    var fechaHora2  = calEvent.end.format().split("T");
                    $("#txtFecha").val(fechaHora[0]);
                    $("#start_date").val(fechaHora[1]);
                    $("#end_date").val(fechaHora2[1]);
                    $("#procedimiento_id").val(calEvent.procedimiento);
                    document.getElementById("btnModificar").click();
                 }',
            ]);

        return view('paciente.agenda',compact('procedimiento','calendar_details','paciente'));
    }

    public function addEvent(Request $request){
        $validator = Validator::make($request->all(), [
            'pacienteID'       => 'required',
            'start_date'        => 'required',
            'end_date'          => 'required',
            'procedimiento_id'  => 'required' 
        ]);
        if($validator->fails()){
            \Session::flash('warnning', 'Porfavor ingrese datos validos');
            return redirect()->route('paciente.agenda',$request->pacienteID)->withInput()->withErrors($validator);
        }
        if(isset($_POST["btnAgregar"])){
        $event = new Events();
        $event->paciente_id         = $request['pacienteID'];
        $event->start_date          = $request['txtFecha']." ".$request['start_date'];
        $event->end_date            = $request['txtFecha']." ".$request['end_date'];
        $event->procedimiento_id    = $request['procedimiento_id'];
        $event->descripcion         = $request['txtDescripcion'];
        $event->save();
        \Session::flash('success','Cita añadida exitosamente');
        return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita guardada con exito');

        }elseif (isset($_POST["btnModificar"])) {
            $event = Events::find($request["txtID"]);
            $event->paciente_id         = $request['pacienteID'];
            $event->start_date          = $request['txtFecha']." ".$request['start_date'];
            $event->end_date            = $request['txtFecha']." ".$request['end_date'];
            $event->procedimiento_id    = $request['procedimiento_id'];
            $event->save();
            return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita actualizada con exito');
        }elseif (isset($_POST['btnEliminar'])) {
            $event = Events::find($request["txtID"]);
            $event->delete();
            return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita eliminada con exito');

        }

        
    }

}
