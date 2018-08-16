@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Usuario
					</div>
					<div class="panel-body">
						{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT']) !!}
							@include('user.partials.formEdit')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection