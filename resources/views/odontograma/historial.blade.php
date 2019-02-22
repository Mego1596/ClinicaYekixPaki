@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
<a href="{{route('paciente.index')}}">Paciente</a>
</li>

<li class="breadcrumb-item">
<a href="{{route('paciente.show', $paciente)}}" class="breadcrumb-item">Detalle Paciente</a>
</li>

<li class="breadcrumb-item">
    <a href="{{route('odontograma.index', $paciente)}}" class="breadcrumb-item">Odontogramas</a>
</li>

<li class="breadcrumb-item">
    <a class="breadcrumb-item active">Historial</a>
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
								<a href="{{ route('odontograma.index', $paciente) }}" class="btn btn-block btn-secondary" style="width: 100%"><i class="fa fa-arrow-circle-left"></i>
								Atrás</a>
							</div>
							<div class="col-md-8">
								<h4>Historial de Odontogramas</h4>
							</div>
						</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="row">
                                @foreach ($odontogramas as $odontograma)                                    
                                <div class="col-md-3 col-xs-6 thumb">
                                <a class="thumbnail" href="#" data-image-id="{{$odontograma->id}}" data-toggle="modal" data-title="Fecha: {{date('d-m-Y', strtotime($odontograma->created_at))}}"
                                       data-image="{{$odontograma->ruta}}"
                                       data-target="#image-gallery">
                                       <figure>
                                        <img class="img-thumbnail"
                                             src="{{$odontograma->ruta}}"
                                             alt="{{$odontograma->nombreOriginal}}">
                                       <figcaption>{{date('d-m-Y', strtotime($odontograma->created_at))}}</figcaption>
                                       </figure>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            </div> 
                            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="image-gallery-title"></h4>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="background-color: lightskyblue">
                                            <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                            </button>
                    
                                            <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>				
				</div>
			</div>
		</div>
	</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/galeria.css')}}">
@endsection

@section('javascript')
<script src="{{asset('js/galeria.js')}}"></script>
@endsection