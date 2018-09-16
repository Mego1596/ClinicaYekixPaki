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
       	$("nombre3").val();
    });

});
</script>
<script>
window.onload = function() {
	var result = document.getElementById('nombre3').value;
	if(result==''){
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

};
</script>
@endsection


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
						{!! Form::model($paciente, ['route' => ['paciente.update', $paciente->id], 'method' => 'PUT','autocomplete'=> 'off']) !!}
							@include('paciente.partials.formEdit')
						{!! Form::close() !!}

						<form action="{{route('paciente.anexos')}}" method="POST" id="anexos" enctype="multipart/form-data">
							{{ csrf_field() }}							
								<input type="file" name="anexo[]" id="anexo" multiple>
								<input type="submit">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection