@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Role
					</div>
					<div class="panel-body">
						{!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}

							@include('roles.partials.form')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection