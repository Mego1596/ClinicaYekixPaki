@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Gestion de Pago</a>
</li>
@endsection


@section('content')
<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card panel-default">
					<div class="card-header text-center">
						<div class="row">
			            	<div class="col-md-2 col-sm-12">
			                	<a href="/events" class="btn btn-block btn-secondary" style="width: 100%">
			                	<i class="fa fa-arrow-circle-left"></i> Atrás</a>
			              	</div>
			              	<div class="col-md-2">
								<strong></strong>
			              	</div>
			              	<div class="col-md-3">
								<h4>Realizar Pago</h4>
			              	</div>
          				</div>

					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md" >
							<thead>
								<tr align="center">
									<th>Fecha</th>
									<th>Tratamiento Realizado</th>
									<th>Realizo el Tratamiento</th>
									<th>Abono</th>
									<th>Saldo</th>
									<th>Proxima Cita</th>
									@if (sizeof($pagos) == 0)
										@if($abonoValidar == 0 )

										@else
												@if(sizeof($pagos) > 1)

												@else
													<th width="237">
														@can('pagos.create')
														<a href="{{ route('pago.create',['cita' => $id]) }}" class="btn btn-block btn-success pull-right">
														<i class="fa fa-money"></i>	
														Crear Pago
														</a>
														@endcan
													</th>
												@endif
										@endif
									@else
										@if($abonoValidar == 0)
										<th></th>
										<th></th>
										@else
												@if(sizeof($pagos) > 1)
													<th width="237">
														@can('pagos.create')
														<a href="{{ route('pago.create', ['cita' => $id]) }}" class="btn btn-block btn-success pull-right">
														<i class="fa fa-money"></i>	
														Crear Pago
														</a>
														@endcan
													</th>
												@else
												<th></th>
												<th></th>
												@endif
										@endif
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($pagos as $proceso)
								<tr>
									@php
										$date=date_create($proceso->created_at);
										$aux= date_format($date,"d-m-Y");
									@endphp
									<td width="106px" align="center">{{$aux}}</td>
									<td width="100px" align="center">{{$procesoNombre}}</td>
									<td align="center">{{$proceso->realizoTto}}</td>
									<td align="center">${{$proceso->abono}}</td>
									<td align="center">${{$proceso->saldo}}</td>
									@php
										$date2=date_create($proceso->proximaCita);
										$aux2= date_format($date2,"d-m-Y");
									@endphp
									<td align="center">{{$aux2}}</td>
									<td></td>
									@can('pagos.edit')
										<td>
											<a href="{{ route('pago.edit', $proceso->id) }}" class="btn btn-info">Editar</a>
										</td>
									@endcan
	pagos.edit		</tr>
								@endforeach
							</tbody>
						</table>
						{{$pagos->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection