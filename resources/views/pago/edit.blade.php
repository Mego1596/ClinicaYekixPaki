@extends('layouts.base')

@section('bread')

<li class="breadcrumb-item">
  <a href="{{route('events.index')}}">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('pago.index',['cita' => $pago->events_id] )}}">Gestionar Pago</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Editar Pago</a>
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
								<a href="{{ route('pago.index',['cita' => $pago->events_id]) }}" class="btn btn-block btn-secondary" style="width: 100%">
								<i class="fa fa-arrow-circle-left"></i> Atrás</a>
							</div>
							<div class="col-md-8">
								<h4>Asignar Pago</h4>
							</div>
						</div>
					
					</div>
					<div class="card-body">
						{!! Form::model($pago, ['route' => ['pago.update', $pago->id], 'method' => 'PUT' , 'autocomplete'=> 'off', 'id' => 'formEdit']) !!}

							@include('pago.partials.form')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
<script>
     
        $(document).ready(function(){
            let formulario = document.getElementsByTagName("form")[1];
            if(formulario.action.lastIndexOf("update")){
                document.getElementById('btnVerificar').style.visibility = 'hidden'
                document.getElementById('btnEnviar').style.visibility = 'visible'
                document.getElementById('abono1').disabled = true
            }
        })
</script>
@endsection