@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Plan de Tratamiento</a>
</li>
@endsection
@section('content')
<br/>
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card panel-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-2 col-sm-12">
								<a href="{{ route('events.index') }}" class="btn btn-block btn-secondary" style="width: 100%">
								<li class="fa fa-arrow-circle-left"></li>Atrás</a>
							</div>
							<div class="col-md-8">
								<h4>Plan de Tratamiento</h4>
								@foreach($persona as $pacient)
									<h5>
										<label>
											<strong>{{$pacient->nombre1.' '.$pacient->nombre2.' '.$pacient->nombre3.' '.$pacient->apellido1.' '.$pacient->apellido2}}
											</strong>
										</label>
									</h5>
								@endforeach
							</div>
							<div class="col-md-12 col-sm-12">
							@foreach($planTratamiento as $plan)
								@if($loop->first)
									@if($plan->comenzado != true)
										<a href="{{ route('planTratamiento.iniciarPlanTratamiento', ['cita'=> $id] )}}" class="btn btn-sm btn-default bg-dark" style="color: white">
										<i class="fa fa-cog"></i> Comenzar Plan de Tratamiento
										</a>
									@endif
								@endif
							@endforeach
							</div>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th width="10px">Nombre</th>
									<th width="10px">Estado</th>
									<th width="120px">No de Piezas</th>
									<th width="10px">Honorarios</th>
									@if($validador == 1 )
										@if (sizeof($planTratamiento) == 0)
												<th width="237">
													@can('planTratamientos.create')
													<a href="{{ route('planTratamiento.create', ['cita' =>$id,'validador'=>$validador]) }}" class="btn btn-block btn-success pull-right">
													<i class="fa fa-tasks"></i> 
													<i class="fa fa-plus-square" style="font-size: 10px"></i> Crear Plan de Tratamiento
													</a>
													@endcan
												</th>
										@else
											@foreach($planTratamiento as $plan)
												@if($loop->first)
													@if($plan->comenzado != true)
														@if(sizeof($planValidador) == 1 || sizeof($planValidador2) >= 1)
															<th colspan="5" width="237">
																@can('planTratamientos.create')
																<a href="{{ route('planTratamiento.create', ['cita' =>$id,'validador' => $validador])}}" class="btn btn-block btn-success pull-right">
																<i class="fa fa-tasks"></i>
																<i class="fa fa-plus-square" style="font-size: 10px"></i> Crear Plan de Tratamiento
																</a>
																@endcan
															</th>
														@else
															<th colspan="5" width="237"></th>
														@endif
													@endif
													<th colspan="5" width="237"></th>
												@endif
											@endforeach
										@endif
									@else
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($planTratamiento as $proceso)
									<tr>
										<td width="10px">{{$proceso->id}}</td>
										@foreach($proc as $procedimiento)
											@if($proceso->procedimiento_id == $procedimiento->id)
												<td>{{$procedimiento->nombre}}</td>
												@if($proceso->en_proceso == true)
													<td width="150px">
														<label><strong>En Proceso</strong></label>
													</td>
													<td>{{$proceso->no_de_piezas}}</td>
													<td style="text-align: center;">${{$proceso->honorarios}}</td>
													
													<td width="10px">
													@if($proceso->comenzado == true)
													@can('planTratamientos.create')
														<a href="{{ route('planTratamiento.agenda',['cita'=> $id, 'procedimiento'=> $procedimiento->id, 'paciente'=> $paciente,'planTratamiento'=>$proceso->id,'validador'=>$validador] )}}" class="btn btn-sm btn-default bg-dark" style="color: white">
															<i class="fa fa-calendar"></i> Agendar Cita
														</a>
													@endcan
													@endif
													</td>
													@if($proceso->procedencia == 1)
														@if($proceso->comenzado != true)
														<td width="10px">
															@can('planTratamientos.edit')
																<a href="{{ route('planTratamiento.edit', ['cita' =>$id, 'planTratamiento'=> $proceso->id,'validador'=> $validador ]) }}" class="btn btn-sm btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
															@endcan
														</td>
														@endif
													@endif
												@elseif($proceso->completo == true)
													<td width="150px">
														<label><strong>Completo</strong></label>
													</td>
													<td>{{$proceso->no_de_piezas}}</td>
													<td style="text-align: center;">
													${{$proceso->honorarios}}
													</td>
													<td></td>
												@else($proceso->no_iniciado == true)
													<td width="150px">
														<label><strong>No Iniciado</strong></label>
													</td>
													<td>{{$proceso->no_de_piezas}}</td>
													<td style="text-align: center;">
													${{$proceso->honorarios}}
													</td>
													<td width="10px">
													@if($proceso->comenzado == true)
													@can('planTratamientos.create')
														<a href="{{ route('planTratamiento.agenda',['cita'=> $id, 'procedimiento'=> $procedimiento->id, 'paciente'=> $paciente,'planTratamiento'=>$proceso->id,'validador'=>$validador] )}}" class="btn btn-sm btn-default bg-dark" style="color: white">
															<i class="fa fa-calendar"></i> Agendar Cita
														</a>
													@endcan
													@endif
													</td>
												@endif
											@endif
										@endforeach
										@if(sizeof($planValidador) == 1 || sizeof($planValidador2) >= 1)
										<td width="10px">
											@if($proceso->comenzado != true)
											@can('planTratamientos.edit')
												<a href="{{ route('planTratamiento.edit', ['cita' =>$id, 'planTratamiento'=> $proceso->id,'validador'=> $validador ]) }}" class="btn btn-sm btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
											@endcan
											@endif
										</td>
										@if($proceso->comenzado != true)
											<td width="10px">
												<!-- Button trigger modal -->
												<button type="button" class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#Modal22{{$proceso->id}}"><i class="fa fa-trash"></i>
												     Eliminar
												</button>
											</td>
										@else
										<td></td>
										@endif
											{!! Form::open(['route' => ['planTratamiento.destroy', $proceso->id],'method' => 'DELETE']) !!}
											<!-- Modal -->
												<div class="modal fade" id="Modal22{{$proceso->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Plan de Tratamiento</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<label>¿Eliminar Tratamiento?
																</label>
																<br/>
																<button type="button" class="btn btn-md btn-default" data-dismiss="modal">No
																</button>
																<button class="btn btn-md btn-default bg-danger" style="color: white">
																	Si
																</button>
															</div>
																<div class="modal-footer">
																</div>
														</div>
													</div>
												</div>
											{!! Form::close() !!}
											@endif
										@if(sizeof($planValidador) == 1)
											@if($proceso->en_proceso == true)
												
												@if($proceso->comenzado == true)
												<td width="10px">
													<!-- Button trigger modal -->
													<button type="button" class="btn btn-sm btn-default bg-gray btn-block" data-toggle="modal" data-target="#Modal{{$proceso->id}}"><i class="fa fa-check"></i>
													     Terminar
													</button>
												</td>
												@else
												<td width="105px"></td>
												<td width="200px"></td>
												<td></td>
												@endif
												
												{!! Form::open(['route' => ['planTratamiento.terminar', $proceso->id],'method' => 'POST']) !!}
												<!-- Modal -->
													<div class="modal fade" id="Modal{{$proceso->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Plan de Tratamiento</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<label>¿Completar Tratamiento?
																	</label>
																	<br/>
																	<button type="button" class="btn btn-md btn-default" data-dismiss="modal">No
																	</button>
																	<button class="btn btn-md btn-default bg-success" style="color: white">
																		Si
																	</button>
																</div>
																	<div class="modal-footer">
																	</div>
																</div>
														</div>
													</div>
												{!! Form::close() !!}
												
											@else
												<td></td>
											@endif
										@else
											@if($proceso->completo == true && $proceso->activo != false)
											<td></td>
											@elseif($proceso->no_iniciado == true)
											<td width="10px">
												<!-- Button trigger modal -->
													<button type="button" class="btn btn-sm btn-default bg-gray btn-block" data-toggle="modal" data-target="#Modal{{$proceso->id}}"><i class="fa fa-check"></i>
													     Iniciar
													</button>
													{!! Form::open(['route' => ['planTratamiento.iniciar', $proceso->id],'method' => 'POST']) !!}
												<!-- Modal -->
													<div class="modal fade" id="Modal{{$proceso->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Plan de Tratamiento</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<label>¿Iniciar Tratamiento?
																	</label>
																	<br/>
																	<button type="button" class="btn btn-md btn-default" data-dismiss="modal">No
																	</button>
																	<button class="btn btn-md btn-default bg-success" style="color: white">
																		Si
																	</button>
																</div>
																	<div class="modal-footer">
																	</div>
																</div>
														</div>
													</div>
												{!! Form::close() !!}
											</td>
											@else
											@endif
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
						@role('asistente')
							<div class="row">
								<div class="col-md-2 col-sm-12">
								</div>	
								<div class="col-md-8 col-sm-12">
									<label><strong><h5>Costo Total del Presupuesto: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${{$presupuesto}}</h5></strong></label>
								</div>
								<div class="col-md-2 col-sm-12">
								</div>
								<div class="col-md-2 col-sm-12">
								</div>
								<div class="col-md-8 col-sm-12">
									<label><strong><h5>Abono Total del Presupuesto: &nbsp;&nbsp;&nbsp;${{$abono}}</h5></strong></label>
								</div>
							</div>
						@endrole
						@role('admin')
						<div class="row">
							<div class="col-md-4 col-sm-12">
								
							</div>
							@foreach($planTratamiento as $plan)
								@if($loop->first)
									@if($plan->activo == false && $plan->comenzado == true)
										<div class="col-md-4 col-sm-12">
											<button type="button" class="btn btn-sm btn-block btn-success" data-toggle="modal" data-target="#ModalHabilitar"><i class="fa fa-check"></i>
											     Habilitar Plan
											</button>
												{!! Form::open(['route' => ['planTratamiento.habilitarPlanTratamiento', 'cita' => $id],'method' => 'POST']) !!}
													<!-- Modal -->
													<div class="modal fade" id="ModalHabilitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
													    	<div class="modal-content">
																<div class="modal-header">
													        		<h5 class="modal-title" id="exampleModalLabel"> Plan de Tratamiento</h5>
													        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													          				<span aria-hidden="true">&times;</span>
													        			</button>
													      		</div>
																<div class="modal-body">
											        				<input type="hidden" name="events_id" id="events_id" value="{{$id}}">
												        			<label>Habilitar Plan de Tratamiento?</label>
																	<br />
												        			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
													        		<button class="btn btn-md btn-default bg-success" style="color: white">Si</button>
																</div>
												      			<div class="modal-footer">
																</div>
											    			</div>
														</div>
													</div>
												{!! Form::close() !!}
										</div>
									@endif
									@if($plan->activo != false && $plan->comenzado == true)
										<div class="col-md-4 col-sm-12">
											<button type="button" class="btn btn-sm btn-block btn-danger" data-toggle="modal" data-target="#ModalDeshabilitar"><i class="fa fa-check"></i>
											     Deshabilitar Plan
											</button>
												{!! Form::open(['route' => ['planTratamiento.deshabilitarPlanTratamiento', 'cita' => $id],'method' => 'POST']) !!}
													<!-- Modal -->
													<div class="modal fade" id="ModalDeshabilitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
													    	<div class="modal-content">
																<div class="modal-header">
													        		<h5 class="modal-title" id="exampleModalLabel"> Plan de Tratamiento</h5>
													        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													          				<span aria-hidden="true">&times;</span>
													        			</button>
													      		</div>
																<div class="modal-body">
											        				<input type="hidden" name="events_id" id="events_id" value="{{$id}}">
												        			<label>Deshabilitar Plan de Tratamiento?</label>
																	<br />
												        			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
													        		<button class="btn btn-md btn-default bg-danger" style="color: white">Si</button>
																</div>
												      			<div class="modal-footer">
																</div>
											    			</div>
														</div>
													</div>
												{!! Form::close() !!}
										</div>
									@endif
								@endif
							@endforeach
							<div class="col-md-4 col-sm-12">
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-sm-12">
							</div>	
							<div class="col-md-8 col-sm-12">
								<label><strong><h5>Costo Total del Presupuesto: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${{$presupuesto}}</h5></strong></label>
							</div>
							<div class="col-md-2 col-sm-12">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#Modal"><i class="fa fa-check"></i>
								     Finalizar Plan
								</button>
							</div>
							<div class="col-md-2 col-sm-12">
							</div>
							<div class="col-md-8 col-sm-12">
								<label><strong><h5>Abono Total del Presupuesto: &nbsp;&nbsp;&nbsp;${{$abono}}</h5></strong></label>
							</div>
						</div>
						{!! Form::open(['route' => ['planTratamiento.finalizar', 'cita' => $id],'method' => 'POST']) !!}
							<!-- Modal -->
							<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
							    	<div class="modal-content">
							    		<div class="modal-header">
							        		<h5 class="modal-title" id="exampleModalLabel"> Plan de Tratamiento</h5>
							        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          				<span aria-hidden="true">&times;</span>
							        			</button>
							      		</div>
							      		<div class="modal-body">
							        		<input type="hidden" name="events_id" id="events_id" value="{{$id}}">
							        		<label>Finalizar Plan de Tratamiento?</label>
							        		<br />
							        		<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
								        	<button class="btn btn-md btn-default bg-danger" style="color: white">Si</button>
								        </div>
							      		<div class="modal-footer">
							      		</div>
							    	</div>
								</div>
							</div>
						{!! Form::close() !!}
						@endrole
						{{$planTratamiento->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection