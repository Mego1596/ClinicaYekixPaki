@extends('layouts.base')
@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-1">
								<a href="{{ route('detalleReceta.index',['receta' => $id ]) }}" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Crear Receta</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::model($detalles, ['route' => ['detalleReceta.update', $detalles->id], 'method' => 'PUT']) !!}
							{!! Form::hidden('id',$id2,['class' => 'form-control']) !!}
							@include('detalleReceta.partials.form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection