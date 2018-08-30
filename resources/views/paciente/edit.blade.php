@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/paciente">Paciente</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Editar Paciente</a>
</li>

@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-1">
								<a href="{{ route('paciente.index') }}" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Editar paciente</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::model($paciente, ['route' => ['paciente.update', $paciente->id], 'method' => 'PUT']) !!}
							@include('paciente.partials.form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection