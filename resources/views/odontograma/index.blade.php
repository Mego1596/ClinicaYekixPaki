@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
<a href="{{route('paciente.index')}}">Paciente</a>
</li>

<li class="breadcrumb-item">
<a href="{{route('paciente.show', $paciente)}}" class="breadcrumb-item">Detalle Paciente</a>
</li>

<li class="breadcrumb-item">
    <a class="breadcrumb-item active">Odontogramas</a>
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
								<a href="{{ route('paciente.show', $paciente) }}" class="btn btn-block btn-secondary" style="width: 100%"><i class="fa fa-arrow-circle-left"></i>
								Atrás</a>
							</div>
							<div class="col-md-8">
								<h4>Detalle de Odontogramas</h4>
							</div>
						</div>
                    </div>
                    <div class="card-body">
                        <div class="row pt-3">
                            <div class="col-md-3 col-sm-12">
                                <a href="#" class="btn btn-primary" role="button">Historial Odontogramas</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                
                                <!--Inicio del dibujo--> 
                                <div class="toolsBars">
                                        <fieldset class="toolsBar">
                                            <legend>Herramientas</legend>
                                            <input type="button" style="background-image: url({{asset('img/lapiz.png')}})" value="lapiz"              onclick="canvasManager.activatePen()" />
                                            <input type="button" style="background-image: url({{asset('img/borrador.png')}})" value="borrador"           onclick="canvasManager.activateEraser()" />
                                            <input type="button" style="background-image: url({{asset('img/circulo.png')}})" value="circulo vacio"      onclick="canvasManager.activateEmptyCircle()" />
                                            <input type="button" style="background-image: url({{asset('img/circuloRelleno.png')}})" value="circulo lleno"      onclick="canvasManager.activateCircle()" />
                                            <input type="button" style="background-image: url({{asset('img/cuadrado.png')}})" value="cuadrado vacio"     onclick="canvasManager.activateEmptyRectangle()" />
                                            <input type="button" style="background-image: url({{asset('img/cuadradoRelleno.png')}})" value="cuadrado lleno"     onclick="canvasManager.activateRectangle()" />
                                            <input type="button" style="background-image: url({{asset('img/linea.png')}})" value="linea"              onclick="canvasManager.activateLine()" />
                                            <input type="button" style="background-image: url({{asset('img/spray.png')}})" value="spray"              onclick="canvasManager.activateSpray()" />
                                            <input type="button" style="background-image: url({{asset('img/save.png')}})" value="guardar"            onclick="canvasManager.save()" />
                                            <input type="button" style="background-image: url({{asset('img/undo.png')}})" value="undo"               onclick="canvasManager.undo()" />
                                            <input type="button" style="background-image: url({{asset('img/redo.png')}})" value="redo"               onclick="canvasManager.redo()" />
                                        </fieldset>
                                            
                                        <fieldset class="toolsBar">
                                            <legend>Color de linea</legend>
                                            <input type="button" style="background-color: red;" value="color rojo linea"   onclick="canvasManager.changeStrokeColor('red')" />
                                            <input type="button" style="background-color: blue;" value="color azul linea"   onclick="canvasManager.changeStrokeColor('blue')" />
                                            <input type="button" style="background-color: green;" value="color verde linea"   onclick="canvasManager.changeStrokeColor('green')" />
                                            <input type="button" style="background-color: yellow;" value="color amarillo linea"   onclick="canvasManager.changeStrokeColor('yellow')" />
                                            <input type="button" style="background-color: black;" value="color negro linea"   onclick="canvasManager.changeStrokeColor('black')" />
                                            <input type="button" style="background-color: pink;" value="color rosa linea"   onclick="canvasManager.changeStrokeColor('pink')" />
                                            <input type="button" style="background-color: brown;" value="color marron linea"   onclick="canvasManager.changeStrokeColor('brown')" />
                                        </fieldset>	
                                            
                                        <fieldset class="toolsBar">
                                            <legend>Color de relleno</legend>
                                            <input type="button" style="background-color: red;" value="color rojo relleno"   onclick="canvasManager.changeFillColor('red')" />
                                            <input type="button" style="background-color: blue;" value="color azul relleno"   onclick="canvasManager.changeFillColor('blue')" />
                                            <input type="button" style="background-color: green;" value="color verde relleno"   onclick="canvasManager.changeFillColor('green')" />
                                            <input type="button" style="background-color: yellow;" value="color amarillo relleno"   onclick="canvasManager.changeFillColor('yellow')" />
                                            <input type="button" style="background-color: black;" value="color negro relleno"   onclick="canvasManager.changeFillColor('black')" />
                                            <input type="button" style="background-color: pink;" value="color rosa relleno"   onclick="canvasManager.changeFillColor('pink')" />
                                            <input type="button" style="background-color: brown;" value="color marron relleno"   onclick="canvasManager.changeFillColor('brown')" />
                                        </fieldset>	
                                        
                                        <fieldset class="toolsBar">
                                            <legend>Tamaño de linea</legend>
                                            <input type="button" style="background-image: url({{asset('img/tamanio2px.png')}})" value="2 px"            onclick="canvasManager.changeStrokeSize(2)" />
                                            <input type="button" style="background-image: url({{asset('img/tamanio6px.png')}})" value="6 px"            onclick="canvasManager.changeStrokeSize(6)" />
                                            <input type="button" style="background-image: url({{asset('img/tamanio10px.png')}})" value="10 px"            onclick="canvasManager.changeStrokeSize(10)" />
                                            <input type="button" style="background-image: url({{asset('img/tamanio15px.png')}})" value="15 px"            onclick="canvasManager.changeStrokeSize(15)" />
                                            <input type="button" style="background-image: url({{asset('img/tamanio20px.png')}})" value="20 px"            onclick="canvasManager.changeStrokeSize(20)" />
                                        </fieldset>
                                        
                                        <fieldset class="toolsBar">
                                            <legend>Otros</legend>
                                            <input type="button" style="background-image: url({{asset('img/opacity100.png')}})" title="densidad 100%" value="opacidad 100%"      onclick="canvasManager.changeOpacity(100)" />
                                            <input type="button" style="background-image: url({{asset('img/opacity50.png')}})" title="densidad 50%" value="opacidad 50%"       onclick="canvasManager.changeOpacity(50)" />
                                            <input type="button" style="background-image: url({{asset('img/sprayLow.png')}})" title="spray poco denso" value="densidad spray 5"   onclick="canvasManager.changeSprayDensity(5)" />
                                            <input type="button" style="background-image: url({{asset('img/sprayHigh.png')}})" title="spray muy denso" value="densidad spray 20"   onclick="canvasManager.changeSprayDensity(20)" />
                                        </fieldset>
                                    </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                    <div style="width: 100%; height: 400px; border: solid 2px" class="canvas"></div>
                            </div>
                            
                        <form method="POST" id="formCanvas" action="{{route('odontograma.store', $paciente)}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="imagen" id="imagen">
                        </form>

                        
                        </div>
                    </div>				
				</div>
			</div>
		</div>
	</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/canvas.css')}}">
@endsection

@section('javascript')
<script src="{{asset('js/canvas.js')}}"></script>

<script>
    var canvasManager;
        $(window).load(function () {
            canvasManager = $(".canvas").canvasPaint();
            //canvasManager.loadBackgroundImage("{{asset('img/odontograma.png')}}")

        var canvas = document.getElementsByTagName("canvas")[0];
        var ctx = canvas.getContext("2d");

        var img = new Image();
        img.src = "{{asset('img/odontograma.png')}}";
        img.onload = function(){
            ctx.drawImage(img, 0, 0);
        }
        });

</script>
@endsection