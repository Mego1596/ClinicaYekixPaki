@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{ route('receta.index',['cita' => $id ]) }}">Receta</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Editar Receta</a>
</li>
@endsection
@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
					<div class="row">
							<div class="col-md-1">
								<a href="{{ route('receta.index',['cita'=> $id]) }}" class="btn btn-block btn-secondary" style="width: 130%">
								<li class="fa fa-arrow-circle-left"></li> Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Editar Receta</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::model($recetas, ['route' => ['receta.update', $recetas->id], 'method' => 'PUT', 'autocomplete'=> 'off']) !!}
							{!! Form::hidden('id',$id2,['class' => 'form-control']) !!}
							@include('receta.partials.form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection