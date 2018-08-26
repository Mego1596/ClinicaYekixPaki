@extends('layouts.base').

@section('bread')
<li class="breadcrumb-item">
  <a href="/paciente">Paciente</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Crear Paciente</a>
</li>

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header text-center">
					<div class="row">
						<div class="col-md-1">
							<a href="{{ route('paciente.index') }}" class="btn btn-block btn-secondary">
							Atrás</a>
						</div>
						<div class="col-md-10">
							<h4>Datos del usuario</h4>
						</div>
					</div>
				</div>
				<div class="card-body justify-content-center">

					{!! Form::open(['route' => 'paciente.store']) !!}

						@include('paciente.partials.form')

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>

@endsection