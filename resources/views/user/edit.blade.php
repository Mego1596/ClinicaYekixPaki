@extends('layouts.base')

@section('javascript')

<script>
$(document).ready(function(){
	var result = document.getElementById('nombre3').value;
    $("#cosa").click(function(){
        document.getElementById('nombre3').style.display = 'block';
        document.getElementById('nombre3.2').style.display = 'block';
       	$("#cosa2").prop('checked',false);
       	$("#cosa").prop('disabled',true);
       	$("#cosa2").prop('disabled',false);
       	$("#nombre3").val(result);
       	$("#nombre3").focus();
    });
    $("#cosa2").click(function(){
        document.getElementById('nombre3').style.display = 'none';
        document.getElementById('nombre3.2').style.display = 'none';
       	$("#cosa").prop('checked',false);
       	$("#cosa2").prop('disabled',true);
       	$("#cosa").prop('disabled',false);
       	$("nombre3").val('');
    });

        $("#cosa3").click(function(){
        document.getElementById('numeroJunta').style.display = 'block';
        document.getElementById('numeroJunta2').style.display = 'block';
        document.getElementById('nom').style.visibility = 'visible';
        document.getElementById('cosa5').style.display = 'inline';
        document.getElementById('radio5').style.visibility = 'visible';
        document.getElementById('cosa6').style.display = 'inline';
        document.getElementById('radio6').style.visibility = 'visible';
        if($("#cosa5").prop('checked') == true){
          document.getElementById('especialidad').style.display = 'block';
          document.getElementById('especialidad2').style.display = 'block';
        }
        $("#cosa4").prop('checked',false);
        $("#cosa3").prop('disabled',true);
        $("#cosa4").prop('disabled',false);
        $("#numeroJunta").focus();
    });
    $("#cosa4").click(function(){
        document.getElementById('numeroJunta').style.display = 'none';
        document.getElementById('numeroJunta2').style.display = 'none';
        document.getElementById('nom').style.visibility = 'hidden';
        document.getElementById('cosa5').style.display = 'none';
        document.getElementById('radio5').style.visibility = 'hidden';
        document.getElementById('cosa6').style.display = 'none';
        document.getElementById('radio6').style.visibility = 'hidden';
        document.getElementById('especialidad').style.display = 'none';
        document.getElementById('especialidad2').style.display = 'none';
        $("#cosa3").prop('checked',false);
        $("#cosa4").prop('disabled',true);
        $("#cosa3").prop('disabled',false);
        $("#numeroJunta").val("");
        $("#especialidad").val("");
    });

    $("#cosa5").click(function(){
        document.getElementById('especialidad').style.display = 'block';
        document.getElementById('especialidad2').style.display = 'block';
        $("#cosa6").prop('checked',false);
        $("#cosa5").prop('disabled',true);
        $("#cosa6").prop('disabled',false);
        $("#especialidad").focus();
    });
    $("#cosa6").click(function(){
        document.getElementById('especialidad').style.display = 'none';
        document.getElementById('especialidad2').style.display = 'none';
        $("#cosa5").prop('checked',false);
        $("#cosa6").prop('disabled',true);
        $("#cosa5").prop('disabled',false);
        $("#especialidad").val("");
    });
});
</script>

<script>
window.onload = function() {
	var result = document.getElementById('nombre3').value;
	if(result=='N/A'){
		$("#cosa2").prop('checked',true);
       	$("#cosa2").prop('disabled',true);
       	document.getElementById('nombre3').style.display = 'none';
        document.getElementById('nombre3.2').style.display = 'none';
	}else{
		$("#cosa").prop('checked',true);
       	$("#cosa").prop('disabled',true);
       	document.getElementById('nombre3').style.display = 'block';
        document.getElementById('nombre3.2').style.display = 'block';
	}

	var result2 = document.getElementById('numeroJunta').value;
	if(result2 == ''){
		$("#cosa4").prop('checked',true);
    $("#cosa4").prop('disabled',true);
    document.getElementById('numeroJunta').style.display = 'none';
    document.getElementById('numeroJunta2').style.display = 'none';
	}else{
		$("#cosa3").prop('checked',true);
    $("#cosa3").prop('disabled',true);
    document.getElementById('numeroJunta').style.display = 'block';
    document.getElementById('numeroJunta2').style.display = 'block';
    document.getElementById('nom').style.visibility = 'visible';
    document.getElementById('cosa5').style.display = 'inline';
    document.getElementById('radio5').style.visibility = 'visible';
    document.getElementById('cosa6').style.display = 'inline';
    document.getElementById('radio6').style.visibility = 'visible';

  var result3 = document.getElementById('especialidad').value;
  if(result3 =''){
    $("#cosa6").prop('checked',true);
    $("#cosa6").prop('disabled',true);
    document.getElementById('especialidad').style.display = 'none';
    document.getElementById('especialidad2').style.display = 'none';
  }else{
    $("#cosa5").prop('checked',true);
    $("#cosa5").prop('disabled',true);
    document.getElementById('especialidad').style.display = 'block';
    document.getElementById('especialidad2').style.display = 'block';
  }





	}

};
</script>

@endsection

@section('bread')
@if($idRole == 'doctor')
	<li class="breadcrumb-item">
	  <a href="/user">Odontologo</a>
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