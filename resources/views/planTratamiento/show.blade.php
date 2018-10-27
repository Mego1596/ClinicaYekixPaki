<!DOCTYPE html>
<html>
<head>
    <title>Plan Tratamiento</title>
    <style type="text/css">
    .titulo{
        text-align: center;
        padding-bottom: -1rem;
        font-family: Arial, Helvetica, sans-serif;
        font-weight:bolder;
        font-size: 17px;
    }

    .titulo2{
        text-align: center;
        padding-bottom: -1rem;
        padding-top: -1rem;
    }

    .titulo3{
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        font-weight:bolder;
        font-size: 15px;
        padding-bottom: -5rem;
        padding-top: .5rem;
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
    .odonto{
        padding-left: 1rem;
        margin-top:3rem;
    }
    .odonto2{
        padding-left: 1rem;
        margin-top: 3.5rem;
    }
    div.page_break{
    page-break-before: always;
    }
    </style>
</head>
<body>

<div>


        
    <style type="text/css">
        .tg2  {border-collapse:collapse;border-spacing:0;}
        .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:1px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:1px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg2 .tg-y9452{font-size:20px;font-family:"Arial Black", Gadget, sans-serif !important;;border-color:#ffffff;text-align:center;}
        .tg2 .tg-dfg12{font-size:10px;border-color:#ffffff;text-align:center;vertical-align:top}
        .tg2 .tg-401l2{font-size:11px;border-color:#ffffff;text-align:center;}
        .tg2 .tg-ior22{font-size:11px;border-color:#ffffff;text-align:center;vertical-align:top}
        </style>
        <table class="tg2">
          <tr>
            <th class="tg-401l2" rowspan="2"><img src="img/titulo-yekixpaki.png" alt="Clinica YekiXPaki" width="365" height="95"></th>
            <th class="tg-y9452"><span style="font-weight:bold">FICHA ODONTOLÓGICA</span></th>
          </tr>
          <tr>
            <td class="tg-401l2">Coronas, placas, puentes, rellenos, endodoncias, ortodoncias,<br>todo lo relacionado con Odontologia general, estetica e infantil.</td>
          </tr>
          <tr>
            <td class="tg-ior22" rowspan="2"><br>Col. Libertad, Av. Washington #414, San Salvador.<br>Telefono: 2102 - 2198</td>
            <td class="tg-ior22">De Lunes a miercoles, viernes y sabado de 2:00 pm a 6:00 pm</td>
          </tr>
          <tr>
            <td class="tg-dfg12"><span style="font-weight:bold">Telefono: (503) 6420-8735</span> - Domingos por cita</td>
          </tr>
        </table>
        <p class="titulo2">--------------------------------------------------------------------------------------------------------------------------------</p>
        <p class="titulo " style="font-weight:bold">DATOS DEL PACIENTE</p>


        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;padding-left: .5rem;}
            .tg td{font-family:Arial, sans-serif;font-size:11px;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black; width: 400px;}
            .tg th{font-family:Arial, sans-serif;font-size:11px;font-weight:normal;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg .tg-s268{text-align:left}
            .tg .tg-0lax{text-align:left;vertical-align:top}
            .tg .bordes1{border-right: 1px solid white;border-left: 1px solid white;border-top: 1px solid white;}
            .tg .der{border-right: 1px solid white;}
            </style>
            <table class="tg" style="undefined;table-layout: fixed; width: 685px">
            <colgroup>
            <col style="width: 337px">
            <col style="width: 239px">
            </colgroup>
              <tr>
                <th class="tg-s268 bordes1">Fecha: {{$nuevaFecha}}  </th>
                <th class="tg-0lax bordes1">Ficha#: {{$cit->id}} </th>
              </tr>
              <tr>
              <td class="tg-0lax">E-mail: {{$paciente->email}}</td>
              <td class="tg-0lax">FC: {{$paciente->expediente}}</td>
              </tr>
              <tr>
               <td class="tg-0lax">Nombre: {{$paciente->nombre1}} {{$paciente->nombre2}} {{$paciente->nombre3}} {{$paciente->apellido1}} {{$paciente->apellido2}} </td>
             <td class="tg-0lax">Edad: {{$edad}} años</td>
              </tr>
              <tr>
              <td class="tg-0lax">Ocupacion: {{$paciente->ocupacion}}</td>
              <td class="tg-0lax">Responsable: {{$paciente->responsable}}</td>
              </tr>
              <tr>
              <td class="tg-0lax" colspan="2">Domicilio: {{$paciente->domicilio}}</td>
              </tr>
              <tr>
                <td class="tg-0lax der"></td>
              <td class="tg-0lax">Telefono: {{$paciente->telefono}}</td>
              </tr>
              <tr>
              <td class="tg-0lax" colspan="2">Recomendado Por: {{$paciente->recomendado}}</td>
              </tr>
              <tr>
              <td class="tg-0lax" colspan="2">Historia Odontologica Anterior:</td>
              </tr>
              <tr>
                @if(!is_null($paciente->historiaOdontologica))
                <td class="tg-0lax" colspan="2">{{$paciente->historiaOdontologica}}</td>
                @else
                    <td class="tg-0lax" colspan="2">
                        <br />
                    </td>
                @endif
              </tr>
              <tr>
                <td class="tg-0lax" colspan="2">Historia Medica Anterior:</td>
              </tr>
              <tr>
                @if(sizeof($historias_medicas) != 0)
                    <td class="tg-0lax" colspan="2">
                        @foreach($historias_medicas as $historia)
                        {{$historia->descripcion}}<br>
                        @endforeach
                    </td>
                @else
                    <td class="tg-0lax" colspan="2">
                        <br />
                    </td>
                @endif
              </tr>
            </table>

</div>


<div>
        <p class="titulo" style="font-weight:bold">ODONTOGRAMA</p>
        <p class="titulo3" style="font-weight:bold">Inicial</p>
        <img src="img/odontograma.png" alt="ODONTOGRAMA" width="660" height="210" class="odonto">
        <p class="titulo3" style="font-weight:bold">Actual</p>
        <img src="img/odontograma.png" alt="ODONTOGRAMA" width="660" height="210" class="odonto2">
</div>

<div class="page_break">

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
                <tr><td width="325px" class="firmas pac">Paciente</td><td class="firmas" style="text-align:center">Medico</td></tr>              
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