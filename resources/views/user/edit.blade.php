@extends('layouts.base')

@section('javascript')

<script>
$(document).ready(function(){
    $("#cosa").click(function(){
        document.getElementById('nombre3').style.display = 'block';
        document.getElementById('nombre3.2').style.display = 'block';
       	$("#cosa2").prop('checked',false);
       	$("#cosa").prop('disabled',true);
       	$("#cosa2").prop('disabled',false);
       	$("#nombre3").focus();
    });
    $("#cosa2").click(function(){
        document.getElementById('nombre3').style.display = 'none';
        document.getElementById('nombre3.2').style.display = 'none';
       	$("#cosa").prop('checked',false);
       	$("#cosa2").prop('disabled',true);
       	$("#cosa").prop('disabled',false);
    });

     $("#cosa3").click(function(){
        document.getElementById('numeroJunta').style.display = 'block';
        document.getElementById('numeroJunta2').style.display = 'block';
       	$("#cosa4").prop('checked',false);
       	$("#cosa3").prop('disabled',true);
       	$("#cosa4").prop('disabled',false);
       	$("#numeroJunta").focus();
    });
    $("#cosa4").click(function(){
        document.getElementById('numeroJunta').style.display = 'none';
        document.getElementById('numeroJunta2').style.display = 'none';
       	$("#cosa3").prop('checked',false);
       	$("#cosa4").prop('disabled',true);
       	$("#cosa3").prop('disabled',false);
    });

});
</script>

@endsection

@section('bread')
@if($idRole == 'doctor')
	<li class="breadcrumb-item">
	  <a href="/user">Dentista</a>
	</li>
@endif
@if($idRole == 'asistente')
	<li class="breadcrumb-item">
	  <a href="/asistente">Asistente</a>
	</li>
@endif
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Editar Usuario</a>
</li>

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header text-center">
					<div class="row">
						<div class="col-md-1">
						@if($idRole == 'doctor')
							<a href="{{ route('user.index') }}" class="btn btn-block btn-secondary">
							Atrás</a>
						@endif
						@if($idRole == 'asistente')
							<a href="{{ route('user.asistente') }}" class="btn btn-block btn-secondary">
							Atrás</a>
						@endif
						</div>
						<div class="col-md-10">
							<h4>Datos del usuario</h4>
						</div>
					</div>
				</div>
				<div class="card-body justify-content-center">
						{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT']) !!}
							@include('user.partials.formEdit')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection