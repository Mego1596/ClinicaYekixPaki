<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Procedimiento;
use App\Events;
use App\Paciente;
use App\User;
use App\HistoriaMedica;
use App\Plan_Tratamiento;
use Calendar;
use Validator;

use Mail;
use App\Http\Requests\PacienteRequest;
use App\Http\Requests\PacienteUpdateRequest;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        Auth::user()->id;
        $loggedUser=Auth::id();
        $result =  DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('users.id', '=', $loggedUser)->value('role_id');
        if($result == 5){
            $pacientes = Paciente::where('email',Auth::user()->email)->paginate(1);
            $user = User::where('email','=',Auth::user()->email)->paginate(1);
            $head = 'Paciente';
            return view('paciente.index', compact('pacientes','head','user'));
        }else{
            $pacientes = Paciente::paginate(10);
            $user = User::paginate(10); 
            $head = 'Lista de Pacientes';
            return view('paciente.index', compact("pacientes",'head','user')); 
        }
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
    public function store(PacienteRequest  $request)
    {

        $valores = $request->all();
        //Verificando si estan todos los campos obligatorios

            if(is_null($valores['nombre1']) or is_null($valores['apellido1']) 
            or is_null($valores['fechaNacimiento']) 
            or is_null($valores['telefono']) or is_null($valores['sexo'])
            or is_null($valores['domicilio']) or is_null($valores['ocupacion'])){
                
                return redirect()->route('paciente.create')
                        ->with('error', 'Complete los campos obligatorios')
                        ->withInput($valores)
                        ->with('tipo', 'danger');
                
            }


            /**generando password */
            $password=substr(md5(microtime()),1,6);



            $user = new User();
            $user->nombre1 = $request->nombre1;
            $user->apellido1 = $request->apellido1;
            $user->password=$password;
            //** enviando email, contraseña */
            if(!is_null($request['nombre2']))
            $user->nombre2 = $request->nombre2;
            if(!is_null($request['nombre3']))
            $user->nombre3 = $request->nombre3;
                if(!is_null($request['apellido2']))
            $user->apellido2 = $request->apellido2;

            $fecha_actual = \Carbon::now();
            $anio = substr($fecha_actual,2,2);
            $paciente = new Paciente();
            $paciente->nombre1               = $request->nombre1;
            $apellido                        = $request->apellido1;
            $inicio                          = strtoupper($request->apellido1[0]);
            $apellido[0]                     =$inicio;
            $inicio                          =$inicio."%".$anio;
            $string = "SELECT expediente FROM pacientes WHERE expediente LIKE '".$inicio."' AND id IN (SELECT MAX(id) FROM pacientes WHERE expediente LIKE '".$inicio."')";
            $query                           = DB::select( DB::raw($string));

        if($query != NULL)
        {
            foreach ($query as $key => $value) {

                if( (int) substr($value->expediente,1,3) <= 9 ){
                    $paciente->expediente =$apellido[0]."00".strval((int) substr($value->expediente,1,3)+1)."-".$anio;
                    $user->name =$request->nombre1[0].$apellido[0]."00".strval((int) substr($value->expediente,1,3)+1)."-".$anio;
                }elseif ( (int) substr($value->expediente,1,3) >= 10 && (int) substr($value->expediente,1,3) <= 99 ) {
                        $paciente->expediente =$apellido[0]."0".strval((int) substr($value->expediente,1,3)+1)."-".$anio;
                        $user->name=$request->nombre1[0].$apellido[0]."0".strval((int) substr($value->expediente,1,3)+1)."-".$anio;
                }else{
                    $paciente->expediente =$apellido[0].strval((int) substr($value->expediente,1,3)+1)."-".$anio;
                    $user->name = $request->nombre1[0].$apellido[0].strval((int) substr($value->expediente,1,3)+1)."-".$anio;
                }
                 }
        }else   {
                     $paciente->expediente         = $apellido[0]."001-".$anio;
                    $user->name                   = $request->nombre1[0].$apellido[0]."001-".$anio;
                }

        if(!is_null($request['email'])){
            $user->email = $request->email;
            Mail::send('email.paciente', ['user'=>$user], function ($m) use ($user,$valores) {
                $m->to($user->email,$valores['nombre1']);
                $m->subject('Contraseña y nombre de usuario');
                $m->from('clinicaYekixPaki@gmail.com','YekixPaki');
            });
            $user->password =bcrypt($password);
            $user->save();
            $user->roles()->sync(5);
        }

        $paciente->apellido1              = $apellido;
        $paciente->fechaNacimiento        = $request->fechaNacimiento;
        $paciente->telefono               = $request->telefono;
        $paciente->sexo                   = $request->sexo;
        $paciente->domicilio              = $request->domicilio;
        $paciente->ocupacion              = $request->ocupacion;
        $paciente->user_id                = $user->id;
        $paciente->habilitado             = true;

        //campos opcionales
        if(!is_null($valores['direccion_de_trabajo']))
            $paciente->direccion_de_trabajo = $request->direccion_de_trabajo;
        if(!is_null($valores['responsable']))
            $paciente->responsable = $request->responsable;
        if(!is_null($valores['nombre2']))
            $paciente->nombre2 = $request->nombre2;
        if(!is_null($valores['nombre3']))
            $paciente->nombre3 = $request->nombre3;
         if(!is_null($valores['apellido2']))
            $paciente->apellido2 = $request->apellido2;
         if(!is_null($valores['recomendado']))
            $paciente->recomendado = $request->recomendado;
         if(!is_null($valores['historiaOdontologica']))
            $paciente->historiaOdontologica = $request->historiaOdontologica; 
         if(!is_null($valores['email']))
            $paciente->email = $request->email;       
        if($paciente->save()){
            if(!is_null($valores['historiaMedica'])){
                $historiaMed = new HistoriaMedica();
                $historiaMed->descripcion = $request->historiaMedica;
                $historiaMed->paciente_id = $paciente->id;
                $historiaMed->save();
            }
            return redirect()->route('paciente.show',$paciente->id)
                ->with('info','Paciente guardado con exito')
                ->with('tipo', 'success');
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
        $string ="SELECT id,descripcion FROM historia_medicas WHERE paciente_id=".$paciente->id;
        $historias = DB::select(DB::raw($string));

        $edad= Carbon::parse($paciente->fechaNacimiento)->age;
        $nuevaFecha = date("d/m/Y H:m:s", strtotime($paciente->created_at));        

        foreach ($historias as $key => $value) {
            $value->descripcion;
        }
        return view('paciente.show', compact('paciente','historias','edad','nuevaFecha'));
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
    public function update(PacienteUpdateRequest $request, Paciente $paciente)
    {
        $valores = $request->all();
        //Verificando si estan todos los campos obligatorios
        if(is_null($valores['nombre1']) or is_null($valores['apellido1'])
            or is_null($valores['fechaNacimiento']) or is_null($valores['telefono']) or is_null($valores['sexo'])
            or is_null($valores['domicilio']) or is_null($valores['ocupacion'])){

            return redirect()
                    ->route('paciente.edit',$paciente->id)
                    ->with('error', 'Complete los campos obligatorios')
                    ->with('tipo', 'danger');
        }

        $user = User::find($paciente->user_id);
        if(is_null($request['direccion_de_trabajo']))
            $request['direccion_de_trabajo'] = "Sin direccion de trabajo";

        if(is_null($request['responsable']))
            $request['responsable'] = "Sin responsable";

        if(!is_null($valores['nombre2']))
            $request['nombre2'] = $request->nombre2;
            if(!is_null($user))
                $user->nombre2 = $request->nombre2;

        if(!is_null($valores['nombre3']))
            $request['nombre3'] = $request->nombre3;
            if(!is_null($user))
                $user->nombre3 = $request->nombre3;

         if(!is_null($valores['apellido2']))
            $request['apellido2'] = $request->apellido2;
            if(!is_null($user))
                $user->apellido2 = $request->apellido2;

         if(is_null($valores['recomendado']))
            $request['recomendado'] = "-";
        else
            $request['recomendado'] = $request->recomendado;

         if(is_null($valores['historiaOdontologica']))
            $request['historiaOdontologica'] = "-";
        else
            $request['historiaOdontologica'] = $request->historiaOdontologica;
        
        if(is_null($user)){
            if($request['email'] != null){
                $nuevo = new User();
                $nuevo->name = $request->nombre1[0].$paciente->expediente;
                $nuevo->nombre1 = $request->nombre1;
                $nuevo->apellido1 = $request->apellido1;
                $nuevo->email = $request->email;
                $password=substr(md5(microtime()),1,6);
                $nuevo->password = $password;
                Mail::send('email.paciente', ['user'=>$nuevo], function ($m) use ($nuevo,$request) {
                $m->to($nuevo->email,$request['nombre1']);
                $m->subject('Contraseña y nombre de usuario');
                $m->from('clinicaYekixPaki@gmail.com','YekixPaki');
                });
                $nuevo->password =bcrypt($password);
                $nuevo->save();
                $nuevo->roles()->sync(5);
                $paciente->user_id = $nuevo->id;
            }
        }else{
            if($request->email != null){
                $user->nombre1 = $request->nombre1;
                $user->apellido1 = $request->apellido1;
                $user->email = $request->email;
                $user->save();
            }else{
                $auxiliarid = $paciente->user_id;
                $paciente->user_id = null;
                $paciente->save();
                $usuario = User::find($auxiliarid);
                $usuario->delete();
            }
        }
        $paciente->update($request->all());
        return redirect()->route('paciente.index')
            ->with('info','Paciente actualizado con exito')
            ->with('tipo', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {   
        $users = User::select('id')->where('id',$paciente->user_id)->value('id');
        if(!is_null($users)){
            $aux = User::find($paciente->user_id);
            $paciente->user_id  =   null;
            $paciente->save();
            $aux->delete();
        }
        $paciente->habilitado = false;
        $paciente->save();

        $pacientes = Paciente::paginate(10);
        $user = User::paginate(10); 
        $head = 'Lista de Pacientes';
        return redirect()->route('paciente.index')
            ->with('pacientes',$pacientes)
            ->with('head',$head)
            ->with('user', $user)
            ->with('info','Paciente Inhabilitado con exito')
            ->with('tipo', 'success');
    }

    public function agendar(Paciente $paciente)
    {
        $loggedUser=Auth::id();
        $result =  DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('users.id', '=', $loggedUser)->value('role_id');
        if($result == 1 or $result == 3){
            $encendido = true;
        }else{
            $encendido = false;
        }
        $procesos = Procedimiento::get();
        $procedimiento = Procedimiento::pluck('nombre','id')->toArray();
        $events = Events::select('id','paciente_id','start_date','end_date','descripcion')->where('paciente_id',$paciente->id)->get();
        $event_list= [];
        foreach ($events as $key => $event) {
            $paciente = Paciente::find($event->paciente_id);
            $planT = Plan_Tratamiento::where('events_id',$event->id)->get();
            if(sizeof($planT) > 1 || is_null($planT)){
                $event_list[] =Calendar::event(
                    $paciente->nombre1." ".$paciente->nombre2." ".$paciente->apellido1." ".$paciente->apellido2,
                    false,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date),
                    $event->id,
                    [
                    /*'color'             => $proceso->color,*/
                    'descripcion'       => $event->descripcion,
                    'textColor'         => $event->textcolor,
                    'durationEditable'  => false,
                    ]
                );
            }else{
                $planT = Plan_Tratamiento::where('events_id',$event->id)->value('procedimiento_id');
                $proceso = Procedimiento::where('id',$planT)->value('color');
                $proc1   = Procedimiento::where('id',$planT)->value('id');
                $event_list[] =Calendar::event(
                    $paciente->nombre1." ".$paciente->nombre2." ".$paciente->apellido1." ".$paciente->apellido2,
                    false,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date),
                    $event->id,
                    [
                    'color'             => $proceso,
                    'descripcion'       => $event->descripcion,
                    'textColor'         => $event->textcolor,
                    'procedimiento'     => $proc1,
                    'durationEditable'  => false,
                    ]
                );
            }
        }
        
        

        $calendar_details = Calendar::addEvents($event_list)->setOptions([
            'firstDay'      => 1,
            'editable'      => $encendido,
            'themeSystem'   => 'bootstrap4',
            'locale'        => 'es',
            'header'        => array(
                        'left' => 'prev,next today', 
                      'center' => 'title', 
                       'right' => 'month,agendaWeek,agendaDay'
            ),

            ])->setCallbacks([
            'dayClick' => 'function(date,jsEvent,view){
                //solo si es admin o asistente puede agregar la cita
                if($("#encendido").val() == 1){
                    $("#btnAgregar").prop("disabled",false);
                    $("#btnEliminar").prop("disabled",true);
                    $("#btnModificar").prop("disabled",true);
                    $("#tit").hide();
                    $("#txtTitulo").hide();
                    limpiarFormulario();
                    $("#txtFecha").val(date.format());
                    var horaInicio=String(date).substring(16,24);
                    if(horaInicio == "00:00:00"){
                    }else{
                           $("#start_date").val(horaInicio);
                    }
                    $("#exampleModal").modal();
                }
            }',


            'eventClick' => 'function(calEvent,jsEvent,view){
                //solo si es admin o asistente puede editar la cita
                if($("#encendido").val() == 1){
                    $("#btnAgregar").prop("disabled",true);
                    $("#btnEliminar").prop("disabled",false);
                    $("#btnModificar").prop("disabled",false);
                    $("#txtDescripcion").val(calEvent.descripcion);
                    $("#txtTitulo").val(calEvent.title);
                    $("#txtID").val(calEvent.id);
                    $("#txtColor").val(calEvent.color);
                    FechaHora= calEvent.start._i.split("T");
                    horaInicio=FechaHora[1].split("-");
                    FechaHora2= calEvent.end._i.split("T");
                    horaFin=FechaHora2[1].split("-");
                    $("#txtFecha").val(FechaHora[0]);
                    $("#start_date").val(horaInicio[0]);
                    $("#end_date").val(horaFin[0]);
                    $("#procedimiento_id").val(calEvent.procedimiento);
                    if(calEvent.procedimiento == null){
                            $("#cosa").prop("checked",false);
                            $("#cosa2").prop("checked",true);
                            $("#cosa2").prop("disabled",true);
                            $("#cosa").prop("disabled",false);
                            if($("#cosa2").prop("checked")==true){
                              document.getElementById("procedimiento").style.visibility = "hidden";
                              document.getElementById("procedimiento_id").style.visibility ="hidden";
                            }
                    }else{
                            $("#cosa").prop("checked",true);
                            $("#cosa2").prop("checked",false);
                            $("#cosa2").prop("disabled",false);
                            $("#cosa").prop("disabled",true);
                            if($("#cosa").prop("checked")==true){
                              document.getElementById("procedimiento").style.visibility ="visible";
                              document.getElementById("procedimiento_id").style.visibility ="visible";
                            }
                        }
                    $("#exampleModal").modal();     
                }else{
                    $("#btnAgregar").hide();
                    $("#btnEliminar").hide();
                    $("#btnModificar").hide();
                    $("#txtDescripcion").val(calEvent.descripcion);
                    $("#txtDescripcion").prop("disabled",true);
                    $("#txtTitulo").val(calEvent.title);
                    $("#txtTitulo").prop("disabled",true);
                    $("#txtID").val(calEvent.id);
                    $("#txtColor").val(calEvent.color);
                    FechaHora= calEvent.start._i.split("T");
                    horaInicio=FechaHora[1].split("-");
                    FechaHora2= calEvent.end._i.split("T");
                    horaFin=FechaHora2[1].split("-");
                    $("#txtFecha").val(FechaHora[0]);
                    $("#start_date").val(horaInicio[0]);
                    $("#start_date").prop("disabled",true);
                    $("#end_date").val(horaFin[0]);
                    $("#end_date").prop("disabled",true);
                    $("#procedimiento_id").val(calEvent.procedimiento);
                    $("#procedimiento_id").prop("disabled",true);
                    $("#exampleModal").modal(); 
                }
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

        return view('paciente.agenda',compact('procedimiento','procesos','calendar_details','paciente','encendido'));
    }

    public function addEvent(Request $request){
        $validator = Validator::make($request->all(), [
            'pacienteID'        => 'required',
            'start_date'        => 'required',
            'end_date'          => 'required',
        ]);
        if($validator->fails()){
            \Session::flash('warnning', 'Porfavor ingrese datos validos');
            return redirect()->route('paciente.agenda',$request->pacienteID)->withInput()->withErrors($validator);
        }
        if(isset($_POST["btnAgregar"])){
            if($request->procedimiento_id==NULL){
                $event = new Events();
                $event->paciente_id         = $request['pacienteID'];
                if(strpos($request["txtFecha"], "T")){
                    $event->start_date          = str_replace("T", " ", $request['txtFecha']);
                    $str = substr($request['txtFecha'],0,-9);
                    $event->end_date            = $str." ".$request['end_date'];
                }else{
                    $event->start_date          = $request['txtFecha']." ".$request['start_date'];
                    $event->end_date            = $request['txtFecha']." ".$request['end_date'];
                }
                $event->descripcion         = $request['txtDescripcion'];
                $event->save();
                \Session::flash('success','Cita añadida exitosamente');
                return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita guardada con exito');
            }else{
                $event = new Events();
                $event->paciente_id         = $request['pacienteID'];
                if(strpos($request["txtFecha"], "T")){
                    $event->start_date          = str_replace("T", " ", $request['txtFecha']);
                    $str = substr($request['txtFecha'],0,-9);
                    $event->end_date            = $str." ".$request['end_date'];
                }else{
                    $event->start_date          = $request['txtFecha']." ".$request['start_date'];
                    $event->end_date            = $request['txtFecha']." ".$request['end_date'];
                }
                $event->descripcion         = $request['txtDescripcion'];
                $event->save();
                $tratamiento_cita = new Plan_Tratamiento();
                $tratamiento_cita->procedimiento_id = $request->procedimiento_id;
                $tratamiento_cita->events_id        = $event->id;
                $tratamiento_cita->save();
                \Session::flash('success','Cita añadida exitosamente');
                return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita guardada con exito');
            }
        }elseif (isset($_POST["btnModificar"])) {
            if($request->procedimiento_id==NULL){
                $event = Events::find($request["txtID"]);
                $event->paciente_id         = $request['pacienteID'];
                $event->start_date          = $request['txtFecha']." ".$request['start_date'];
                $event->end_date            = $request['txtFecha']." ".$request['end_date'];
                $event->descripcion         = $request['txtDescripcion'];
                $event->save();
                $plan1 = Plan_Tratamiento::where('events_id',$event->id);
                $plan1->delete();
                return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita actualizada con exito');
            }else{
                $event = Events::find($request["txtID"]);
                $event->paciente_id         = $request['pacienteID'];
                $event->start_date          = $request['txtFecha']." ".$request['start_date'];
                $event->end_date            = $request['txtFecha']." ".$request['end_date'];
                $event->descripcion         = $request['txtDescripcion'];
                $event->save();
                $planAnterior = Plan_Tratamiento::where('events_id',$event->id);
                $planAnterior->delete();
                $tratamiento_cita = new Plan_Tratamiento();
                $tratamiento_cita->procedimiento_id = $request->procedimiento_id;
                $tratamiento_cita->events_id        = $event->id;
                $tratamiento_cita->save();
                return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita actualizada con exito');
            }
        }elseif (isset($_POST['btnEliminar'])) {
            $event = Events::find($request["txtID"]);
            $event->delete();
            return redirect()->route('paciente.agenda',$request->pacienteID)->with('info','Cita eliminada con exito');

        }

        
    }

    public function search(Request $request){
        if($request['buscador']!='Buscar Por...'){
            if($request['buscador'] == 'Nombre'){
                if(!is_null($request['buscar'])){
                    $pacientes = Paciente::where('nombre1','ILIKE', $request->buscar.'%')->orWhere('nombre2','ILIKE', $request->buscar.'%')->orWhere('nombre3','ILIKE', $request->buscar.'%')->paginate();
                    $user = User::paginate();
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'))
                            ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $pacientes = Paciente::paginate(10);
                    $user = User::paginate(10); 
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'));
                }
            }elseif ($request['buscador'] == 'Apellido') {
                if(!is_null($request['buscar'])){
                    $pacientes = Paciente::where('apellido1','ILIKE', $request->buscar.'%')->orWhere('apellido2','ILIKE', $request->buscar.'%')->paginate();
                    $user = User::paginate();
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'))
                            ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $pacientes = Paciente::paginate(10);
                    $user = User::paginate(10); 
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'));
                }
            }elseif ($request['buscador'] == 'Expediente') {
               if(!is_null($request['buscar'])){
                    $pacientes = Paciente::where('expediente','ILIKE', $request->buscar.'%')->paginate();
                    $user = User::paginate();
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'))
                            ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $pacientes = Paciente::paginate(10);
                    $user = User::paginate(10); 
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'));
                }
            }elseif ($request['buscador'] == 'Nombre de Usuario') {
                if(!is_null($request['buscar'])){
                    $pacientes = Paciente::paginate();
                    $user = User::where('name','ILIKE',$request->buscar.'%')->paginate();
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'))
                            ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $pacientes = Paciente::paginate(10);
                    $user = User::paginate(10); 
                    $head = 'Lista de Pacientes';
                    return view('paciente.index', compact("pacientes",'head','user'));
                }
            }
        }else{
             $pacientes = Paciente::paginate(10);
                $user = User::paginate(10); 
                $head = 'Lista de Pacientes';
                return view('paciente.index', compact("pacientes",'head','user'));
        }
    }


    public function habilitar(Paciente $paciente){
        $paciente->habilitado=true;
        $paciente->save();
        $user = User::find($paciente->user_id);

        if(is_null($user)){
            if($paciente->email != null){
                $nuevo = new User();
                $nuevo->name = $paciente->nombre1[0].$paciente->expediente;
                $nuevo->nombre1 = $paciente->nombre1;
                $nuevo->apellido1 = $paciente->apellido1;
                $nuevo->email = $paciente->email;
                $password=substr(md5(microtime()),1,6);
                $nuevo->password = $password;
                Mail::send('email.paciente',['user'=>$nuevo], function ($m) use ($nuevo,$paciente){
                $m->to($nuevo->email,$paciente->nombre1);
                $m->subject('Contraseña y nombre de usuario');
                $m->from('clinicaYekixPaki@gmail.com','YekixPaki');
                });
                $nuevo->password =bcrypt($password);
                $nuevo->save();
                $nuevo->roles()->sync(5);
                $paciente->user_id = $nuevo->id;
                $paciente->save();
        }else{
            if($paciente->email != null){
                $user->nombre1 = $paciente->nombre1;
                $user->apellido1 = $paciente->apellido1;
                $user->email = $paciente->email;
                $user->save();
            }else{
                $auxiliarid = $paciente->user_id;
                $paciente->user_id = null;
                $paciente->save();
                $usuario = User::find($auxiliarid);
                if(!is_null($usuario))
                $usuario->delete();
            }
        }
        $pacientes = Paciente::paginate(10);
        $user = User::paginate(10); 
        $head = 'Lista de Pacientes';
        return redirect()->route('paciente.index')
            ->with('pacientes',$pacientes)
            ->with('head',$head)
            ->with('user', $user)
            ->with('info','Paciente Habilitado Correctamente')
            ->with('tipo', 'success');

        }
    }

}