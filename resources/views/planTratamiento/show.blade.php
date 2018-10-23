<!DOCTYPE html>
<html>
<head>
    <title>Plan Tratamiento</title>
    <style type="text/css">
    .titulo{
        text-align: center;
        padding-bottom: 2rem;
        font-family: Arial, Helvetica, sans-serif;
        font-weight:bolder;
        font-size: 20px;
    }
    .tabla-tra{
        margin-left: 19rem;
    }
    .separador{
        text-align: center;
    }

    .td-proc{

        border: 1px solid black;
        padding: 0em;
    }
    .alig{
        text-align: center;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-weight: bold;
        font-size: 15px;
    }
    .fuente{
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size:14px;
    }

    .bordesB{
        border-left: 1px solid black;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
    }
    .bordesA{
        border-right: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    table{
        border-spacing: none;
    }
    .alineado{
        text-align: center;
    }
    .firmas{
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: 13px;
    }
    .pac{
        padding-left: 5rem;
    }
    div.page_break{
    page-break-before: always;
    }
    </style>
</head>
<body>
<div>

    <p class="titulo" style="font-weight:bold">PLANES DE TRATAMIENTO</p>
	<table border="solid" class="tabla-tra">
            <tr>
                <th width="350px" class="td-proc alig">Clase de Tratamiento</th>
                <th width="160px" class="td-proc alig">No. de Piezas</th>
                <th width="100px" class="td-proc alig">Honorarios</th>
            </tr>
            <tbody>
                @foreach ($procesos as $key => $value1)
                        @foreach ($planTratamiento as $key => $value)
                            @php
                                $x=0;
                            @endphp
                            @if($value->procedimiento_id == $value1->id)
                                <tr >
                                    <td class="td-proc fuente">{{$value1->nombre}}</td>
                                    <td align="center" class="td-proc fuente">{{$value->no_de_piezas}}</td>
                                    <td align="center" class="td-proc fuente">$ {{$value->honorarios}}</td>
                                    @break
                                </tr>
                            @else
                                @php
                                    $x = $loop->iteration+1;
                                @endphp
                                @if($x == sizeof($planTratamiento)+1)
                                    <tr>
                                        <td class="td-proc fuente">{{$value1->nombre}}</td>
                                        <td class="td-proc fuente"></td>
                                        <td class="td-proc fuente"></td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                @endforeach
            </tbody>
            <tr>
                <td class="bordesB fuente" style="font-weight:bold">Costo total del presupuesto ($):</td>
                <td class="bordesA"></td>
                <td class="separador td-proc fuente">
                    $ {{$y}}
                </td>
            </tr>
            </table>
            <p></p>
            <p></p>
            <p></p>
            <table class="tabla-tra" >
                <tr>
                    <td width="325px" class="firmas">F: ____________________________</th>
                    
                    <td class="firmas">F: ____________________________</td>
                </tr>
                <tr><td width="325px" class="firmas pac">Paciente</td><td class="firmas" style="text-align:center">Medica</td></tr>              
            </table>
</div>

<br />
<div class="page_break">
    <table border="solid">
        <tr align="center">
            <th width="120px" class="td-proc alig">Fecha</th>
            <th width="200px" class="td-proc alig">Tratamiento Realizado</th>
            <th width="150px" class="td-proc alig">Realizo el Tto.</th>
            <th width="60px" class="td-proc alig">Abono</th>
            <th width="60px" class="td-proc alig">Saldo</th>
            <th width="120px" class="td-proc alig">Proxima Cita</th>
        </tr>
        <tbody>
            @if(sizeof($pagos) != 0)
                @foreach($pagos as $pagoCita)
                    <tr align="center">
                        @php
                            $date=date_create($pagoCita->created_at);
                            $aux= date_format($date,"d-m-Y");
                        @endphp
                        <td class="td-proc fuente">{{$aux}}</td>
                        @if(sizeof($planTratamiento) < 2)
                            @foreach($planTratamiento as $plan1)
                                @foreach($procesos as $proceso)
                                    @if($plan1->procedimiento_id == $proceso->id)
                                        @foreach($evento as $cita)
                                            @if($plan1->events_id == $cita->id)
                                                <td class="td-proc fuente">{{$proceso->nombre}}<br />
                                                {{$cita->descripcion}}</td>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            @foreach($planTratamiento as $plan1)
                                @if($loop->iteration == 1)
                                    @foreach($procesos as $proceso)
                                        @if($plan1->procedimiento_id == $proceso->id)
                                            @foreach($evento as $cita)
                                                @if($plan1->events_id == $cita->id)
                                                    <td class="td-proc fuente">Revision General:<br />
                                                    {{$cita->descripcion}}</td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        
                        <td class="td-proc fuente">{{$pagoCita->realizoTto}}</td>
                        <td class="td-proc fuente">$ {{$pagoCita->abono}}</td>
                        <td class="td-proc fuente">$ {{$pagoCita->saldo}}</td>
                        @php
                            $date=date_create($pagoCita->proximaCita);
                            $aux= date_format($date,"d-m-Y");
                        @endphp
                        @if(is_null($pagoCita->proximaCita))
                            <td class="td-proc fuente"></td>
                        @else
                            <td class="td-proc fuente">{{$aux}}</td>
                        @endif
                    </tr>

                @endforeach
            @endif
            @foreach ($planTratamiento as $plan1) 
                @foreach ($planTratamientoGeneral as $plan2) 
                    @if($plan1->id == $plan2->referencia)
                        @foreach ($pagosGenerales as $pagosGral)
                            @if($plan2->events_id == $pagosGral->events_id)
                                <tr align="center">
                                @php
                                    $date=date_create($pagosGral->created_at);
                                    $aux= date_format($date,"d-m-Y");
                                @endphp
                                <td class="td-proc fuente">{{$aux}}</td>
                                @foreach($procesos as $proceso)
                                    @if($proceso->id == $plan2->procedimiento_id)
                                        @foreach($eventos as $cita)
                                        @if($plan2->events_id == $cita->id)
                                            <td class="td-proc fuente">{{$proceso->nombre}}<br />
                                            {{$cita->descripcion}}</td>
                                        @endif
                                    @endforeach
                                    @endif
                                @endforeach
                                <td class="td-proc fuente">{{$pagosGral->realizoTto}}</td>
                                <td class="td-proc fuente">${{$pagosGral->abono}}</td>
                                <td class="td-proc fuente">${{$pagosGral->saldo}}</td>
                                @php
                                    $date=date_create($pagosGral->proximaCita);
                                    $aux= date_format($date,"d-m-Y");
                                @endphp
                                @if(is_null($pagosGral->proximaCita))
                                    <td class="td-proc fuente"></td>
                                @else
                                    <td class="td-proc fuente">{{$aux}}</td>
                                @endif
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
<br />
</body>
</html>