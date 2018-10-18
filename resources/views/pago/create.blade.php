@extends('layouts.base')

@section('bread')

<li class="breadcrumb-item">
  <a href="{{route('events.index')}}">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('pago.index', $id )}}">Gestionar Pago</a>
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
								<a href="{{ route('pago.index',$id) }}" class="btn btn-block btn-secondary" style="width: 100%">
								<i class="fa fa-arrow-circle-left"></i> Atrás</a>
							</div>
							<div class="col-md-8">
								<h4>Asignar Pago</h4>
							</div>
						</div>
					
					</div>
					<div class="card-body">
						{!! Form::open(['route' => 'pago.store', 'autocomplete'=> 'off']) !!}

							@include('pago.partials.form')
							{!! Form::hidden('cita', $id, ['class' => 'form-control'])!!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection