@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/procedimiento/">Procedimientos</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Detalle Procedimiento</a>
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
								<a href="{{ route('procedimiento.index') }}" class="btn btn-block btn-secondary" style="width: 100%">
								<i class="fa fa-arrow-circle-left"></i> Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Procedimiento</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
					<p><strong>Nombre: </strong><br>{{ $procedimiento->nombre }}</p>
					<p align="justify"><strong>Descripcion: </strong><br>{{ $procedimiento->descripcion }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection