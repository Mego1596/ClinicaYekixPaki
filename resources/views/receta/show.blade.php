<!DOCTYPE html>
<html>
<head>
	<title>Receta</title>
</head>
<body>
<div>
	<table border="0" cellspacing="0" cellpadding="0">
	 <tr>
	 <td>
	    <table border="0" cellspacing="0" cellpadding="0" style="margin-left: 100px">
	          <tr>
	            <td>
	            	<img src="img/yekipaki1.jpg" alt="Trulli" width="80" height="70">
	            </td>
	            <td>
	            	<table border="0" cellspacing="0" cellpadding="0" style="font-size: 20px">
	            		<tr>
	            			<td>CLINÍCA DENTAL DE ATENCION</td>
	            		</tr>
	            		<tr>
	            			<td align="center">INTEGRAL Y PREVENTIVA</td>
	            		</tr>
	            		<tr style="font-size: 25px;font-family: serif;color: #00b3f2">
	            			<td align="center">"Yekixpaki"</td>
	            		</tr>
	        		</table>
	        	</td>
	            <td>            
	            	<img src="img/yekipaki2.jpg" alt="Trulli" width="60" height="80">
	            </td>
	          </tr>
	    </table>    
	 </td>
	 </tr>
	</table>
</div>
<div style="background: #7ed7f7;margin-top: 10px ; width: 100% ;height: 5px"></div>
<div align="center">
	Col.Libertad Av.Washington #414, San Salvador Telefonos: 2102-2198-6420-8735
</div>
<br/>
<div>
	<label style="font-size: 15px; font-style: italic;">Paciente:</label>
	<label style="text-decoration: underline;font-size: 15px"> {{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label style="font-size: 15px; font-style: italic;">Edad:</label>
	<label style="text-decoration: underline;font-size: 15px">Variable</label>
	<br />
	<label style="font-size: 15px; font-style: italic;">Peso:</label>
	<label style="text-decoration: underline;font-size: 15px"> {{$receta->peso}} lbs.</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label style="font-size: 15px; font-style: italic;">Fecha:</label>
	<label style="text-decoration: underline;font-size: 15px">{{$newDate}}</label>
	<br />
	<label style="font-size: 15px; font-style: italic;">Rp.</label>
	<table border="0" cellspacing="0" cellpadding="0">
	 <tr>
	 <td>
	    <table border="0" cellspacing="0" cellpadding="0" width="500px">
	          @foreach($detalles as $proc)
		        	<tr>
		            	<td>{{$proc->medicamento}}</td>
		          	</tr>
		          	<tr>
		          		<td>{{$proc->dosis}}</td>
		          	</tr>
		          	<tr>
		          		<td>{{$proc->cantidad}}</td>
		          	</tr>
	          @endforeach
	    </table>    
	 </td>
	 </tr>
	</table>
</div>
<br />
<footer>
	<div>
		<table style="border-radius: 5px;border: 2px solid #00b3f2;padding: 5px; width: 100%;height:50px; position: absolute; bottom: 92%;">
			<tr>
				<td align="center" style="font-weight: bold;font-size: 10px">Dra. Kimberly Johanna Amaya Jimenez</td>
			</tr>
			<tr>
				<td align="center" style="font-size: 10px">J.V.P.O 5028</td>
			</tr>
			<tr>
				<td align="center" style="font-size: 10px">Horarios de Lunes a Viernes de 2:00p.m a 6:00 p.m Sabado 8:00 a.m 3:00 p.m
				</td>
			</tr>
			<tr>
				<td align="center" style="font-size: 10px">y mañanas de lunes a viernes</td>
			</tr>
			<tr>
				<td align="center" style="font-size: 10px">TELEFONO 6420-8735 Domingo solo por cita</td>
			</tr>
		</table>
	</div>
</footer>

</body>
</html>