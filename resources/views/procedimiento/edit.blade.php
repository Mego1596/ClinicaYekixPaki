@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/procedimiento/">Procedimientos</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Editar Procedimiento</a>
</li>
@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Procedimiento
					</div>
					<div class="panel-body">
						{!! Form::model($procedimiento, ['route' => ['procedimiento.update', $procedimiento->id], 'method' => 'PUT']) !!}

							@include('procedimiento.partials.form')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection