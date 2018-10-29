@extends('layouts.base')

@section('bread')

<li class="breadcrumb-item">
  <a href="{{route('events.index')}}">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('pago.index',['cita' => $id] )}}">Gestionar Pago</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Realizar Pago</a>
</li>

@endsection


@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-2 col-sm-12">
								<a href="{{ route('pago.index',['cita' => $id]) }}" class="btn btn-block btn-secondary" style="width: 100%">
								<i class="fa fa-arrow-circle-left"></i> Atrás</a>
							</div>
							<div class="col-md-8">
								<h4>Asignar Pago</h4>
							</div>
						</div>
					
					</div>
					<div class="card-body">
						{!! Form::open(['route' => 'pago.store', 'autocomplete'=> 'off', 'onsubmit' => 'return envio()']) !!}

							@include('pago.partials.form')
							{!! Form::hidden('cita', $id, ['class' => 'form-control'])!!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
<script>
		let formValidado = false;
		const envio = () => {
			if(formValidado){
				document.getElementById('realizoTto').disabled = false
				document.getElementById('abono1').disabled = false
				document.getElementById('btnEnviar').disabled = true
				enviado = false //Resetear el envio ya que los ENTER disparan el onSubmit y jamas se enviaría el formulario
			}
			return formValidado;
		}
		//Función encargada de mostrar la modal con los datos a enviar
		const verificarInfo = () => {

			let trataRealizado = $("select[name='realizoTto'] option:selected").text()
			let cantidadAbono = $("#abono1").val()

			$("#odontologo").val(trataRealizado)
			$("#abono").val(cantidadAbono)

			let mensaje
			let errores = false
			if(!$("#realizoTto").val()){
				mensaje = "Debe de seleccionar un Odontólogo. "
				errores = true
			}
			if(cantidadAbono<=0 || cantidadAbono>99999.99){
				mensaje = "El Abono debe esar entre $0.00 - $99999.99"
				errores = true
			}

			if(errores){
				document.getElementById('si').style.visibility = 'hidden'
				$("#informacion").html("<strong>Corrija los errores: </strong>" + "<code>" + mensaje + "</code>")
				document.getElementById('informacion').style.visibility = 'visible'
			}else{
				document.getElementById('si').style.visibility = 'visible'
				document.getElementById('informacion').style.visibility = 'hidden'
			}



			$("#verificarModal").modal()
		}

		const habilitarEnvio = () => {
			document.getElementById('btnVerificar').style.visibility = 'hidden'
			document.getElementById('btnEnviar').style.visibility = 'visible'
			document.getElementById('realizoTto').disabled = true
			document.getElementById('abono1').disabled = true
			formValidado = true
		}
</script>
@endsection