@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Procedimiento
					</div>
					<div class="panel-body">
						{!! Form::open(['route' => 'role.store']) !!}

							@include('role.partials.form')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection