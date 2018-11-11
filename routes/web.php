<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Routes

Route::middleware(['auth'])->group(function(){

	//Roles
	Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:roles.index');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('permission:roles.show');


	//Procedimientos
	Route::post('procedimiento/store', 'ProcedimientoController@store')->name('procedimiento.store')->middleware('permission:procedimientos.create');

	Route::get('procedimiento', 'ProcedimientoController@index')->name('procedimiento.index')->middleware('permission:procedimientos.index');

	Route::get('procedimiento/create', 'ProcedimientoController@create')->name('procedimiento.create')->middleware('permission:procedimientos.create');

	Route::put('procedimiento/{procedimiento}', 'ProcedimientoController@update')->name('procedimiento.update')->middleware('permission:procedimientos.edit');

	Route::get('procedimiento/{procedimiento}', 'ProcedimientoController@show')->name('procedimiento.show')->middleware('permission:procedimientos.show');

	Route::delete('procedimiento/{procedimiento}', 'ProcedimientoController@destroy')->name('procedimiento.destroy')->middleware('permission:procedimientos.destroy');

	Route::get('procedimiento/edit/{procedimiento}', 'ProcedimientoController@edit')->name('procedimiento.edit')->middleware('permission:procedimientos.edit');


	//Usuarios
	Route::post('user/store', 'UserController@store')->name('user.store')->middleware('permission:users.create');

	Route::get('user', 'UserController@index')->name('user.index')->middleware('permission:users.index');

	Route::get('user/create/{idrol}', 'UserController@create')->name('user.create')->middleware('permission:users.create');

	Route::put('user/{user}', 'UserController@update')->name('user.update')->middleware('permission:users.edit');
	
	Route::get('user/show/{user}/{idrol}', 'UserController@show')->name('user.show')->middleware('permission:users.show');

	Route::delete('user/{user}/{idRole}', 'UserController@destroy')->name('user.destroy')->middleware('permission:users.destroy');

	Route::get('user/{user}/edit/{idrol}', 'UserController@edit')->name('user.edit')->middleware('permission:users.edit');

	Route::get('asistente/', 'UserController@asistentes')->name('user.asistente')->middleware('permission:users.asistente');

	Route::get('general', 'UserController@usuarios')->name('user.usuario')->middleware('permission:users.usuarios');

	Route::post('general/grant/{user}', 'UserController@grant')->name('user.grant')->middleware('permission:users.usuarios');
	
	Route::get('user/{user}/revoke/{idrol}', 'UserController@revocarRol')->name('user.revoke');
	
	Route::post('busqueda1/', 'UserController@search1')->name('user.search1');
	
	Route::post('busqueda2/', 'UserController@search2')->name('user.search2');

	Route::post('busqueda3/', 'UserController@search3')->name('user.search3');
	//Full Calendar

	Route::get('events', 'EventsController@index')->name('events.index')->middleware('permission:pacientes.trabajo');
	Route::post('events', 'EventsController@addEvent')->name('events.add');

	Route::get('events/reprogramacion/{cita}', 'EventsController@reprogramarCita')->name('events.reprogramar');

	//Pacientes
	Route::get('file/{file}/download', 'AnexoController@download')->name('file.download');
	
	Route::delete('file/{file}/delete', 'AnexoController@destroy')->name('file.destroy');

	Route::get('paciente/{paciente}/odontograma', 'OdontogramaController@index')->name('odontograma.index')->middleware('permission:odontograma.index');

	Route::post('paciente/{paciente}/odontograma/store', 'OdontogramaController@store')->name('odontograma.store')->middleware('permission:odontograma.store');

	Route::get('paciente/{paciente}/odontograma/historial', 'OdontogramaController@historial')->name('odontograma.historial')->middleware('permission:odontograma.historial');

	Route::post('paciente/store', 'PacienteController@store')->name('paciente.store')->middleware('permission:pacientes.create');

	Route::get('paciente', 'PacienteController@index')->name('paciente.index')->middleware('permission:pacientes.index');

	Route::get('paciente/create', 'PacienteController@create')->name('paciente.create')->middleware('permission:pacientes.create');

	Route::put('paciente/{paciente}', 'PacienteController@update')->name('paciente.update')->middleware('permission:pacientes.edit');

	Route::get('paciente/{paciente}', 'PacienteController@show')->name('paciente.show')->middleware('permission:pacientes.show')->middleware('pacientes');

	Route::delete('paciente/{paciente}', 'PacienteController@destroy')->name('paciente.destroy')->middleware('permission:pacientes.destroy');

	Route::get('paciente/edit/{paciente}', 'PacienteController@edit')->name('paciente.edit')->middleware('permission:pacientes.edit');

	Route::get('paciente/{paciente}/events', 'PacienteController@agendar')->name('paciente.agenda')->middleware('pacientes');
	Route::get('paciente/{paciente}/events/cupos', 'PacienteController@agendar2')->name('paciente.agenda2');
	Route::post('paciente/events', 'PacienteController@addEvent')->name('paciente.add');
	Route::post('busqueda/','PacienteController@search')->name('paciente.search')->middleware('permission:pacientes.create');

	Route::post('paciente/{paciente}','PacienteController@habilitar')->name('paciente.habilitarPaciente')->middleware('permission:pacientes.habilitarPaciente');

	Route::get('paciente/showPlan/{cita}', 'PacienteController@showPlan')->name('paciente.plan')->middleware('permission:paciente.create');


	//Historia Medica
	Route::post('historiaMedica/store', 'HistoriaMedicaController@store')->name('historia.store')->middleware('permission:admin.crearHistoria');

	Route::put('historiaMedica/{historia}', 'HistoriaMedicaController@update')->name('historia.update')->middleware('permission:admin.editarHistoria');

	Route::delete('historiaMedica/{historia}', 'HistoriaMedicaController@destroy')->name('historia.destroy')->middleware('permission:admin.eliminarHistoria');


	//Plan de Tratamiento
	Route::post('planTratamiento/store/', 'PlanTratamientoController@store')->name('planTratamiento.store')->middleware('permission:planTratamientos.create');

	Route::get('planTratamiento/{cita}/{validador}', 'PlanTratamientoController@index')->name('planTratamiento.index')->middleware('permission:planTratamientos.index');

	Route::get('planTratamiento/create/{cita}/{validador}', 'PlanTratamientoController@create')->name('planTratamiento.create')->middleware('permission:planTratamientos.create');

	Route::put('planTratamiento/update/{planTratamiento}/', 'PlanTratamientoController@update')->name('planTratamiento.update')->middleware('permission:procedimientos.edit');

	Route::get('planTratamiento/show/{cita}/{planTratamiento}', 'PlanTratamientoController@show')->name('planTratamiento.show')->middleware('permission:planTratamientos.show');

	Route::delete('planTratamiento/destroy/{planTratamiento}/', 'PlanTratamientoController@destroy')->name('planTratamiento.destroy')->middleware('permission:planTratamientos.destroy');

	Route::get('planTratamiento/edit/{cita}/{planTratamiento}/{validador}', 'PlanTratamientoController@edit')->name('planTratamiento.edit')->middleware('permission:planTratamientos.edit');

	Route::get('planTratamiento/{cita}/{procedimiento}/{paciente}/{planTratamiento}/{validador}/events','PlanTratamientoController@agendar2')->name('planTratamiento.agenda')->middleware('permission:planTratamientos.index');
	
	Route::post('planTratamiento/events', 'PlanTratamientoController@addEvent')->name('planTratamiento.add')->middleware('permission:planTratamientos.index');

	Route::post('planTratamiento/terminar/{planTratamiento}', 'PlanTratamientoController@terminar')->name('planTratamiento.terminar')->middleware('permission:planTratamientos.index');

	Route::post('planTratamiento/iniciar/{planTratamiento}', 'PlanTratamientoController@iniciar')->name('planTratamiento.iniciar')->middleware('permission:planTratamientos.index');

	Route::post('planTratamiento/finalizar/{cita}', 'PlanTratamientoController@finalizar')->name('planTratamiento.finalizar')->middleware('permission:planTratamientos.index');

	//Recetas
	Route::post('receta/store', 'RecetasController@store')->name('receta.store')->middleware('permission:recetas.create');

	Route::get('receta/{cita}', 'RecetasController@index')->name('receta.index')->middleware('permission:recetas.index');

	Route::get('receta/create/{cita}', 'RecetasController@create')->name('receta.create')->middleware('permission:recetas.create');

	Route::put('receta/update/{receta}', 'RecetasController@update')->name('receta.update')->middleware('permission:recetas.edit');

	Route::get('receta/show/{cita}/{receta}', 'RecetasController@show')->name('receta.show')->middleware('permission:recetas.show');

	Route::delete('receta/destroy/{receta}', 'RecetasController@destroy')->name('receta.destroy')->middleware('permission:recetas.destroy');

	Route::get('receta/edit/{cita}/{receta}', 'RecetasController@edit')->name('receta.edit')->middleware('permission:recetas.edit');
	Route::get('receta/enviar/{cita}/{receta}','RecetasController@sendMail')->name('receta.email')->middleware('permission:recetas.email');
	
	//detalle Receta
	Route::post('detalleReceta/store', 'DetalleRecetaController@store')->name('detalleReceta.store')->middleware('permission:admin.crearHistoria');

	Route::get('detalleReceta/{receta}/{cita}', 'DetalleRecetaController@index')->name('detalleReceta.index')->middleware('permission:detalleRecetas.index');

	Route::get('detalleReceta/show/{detalle}/{receta}/{cita}', 'DetalleRecetaController@show')->name('detalleReceta.show')->middleware('permission:detalleRecetas.show');

	Route::get('detalleReceta/create/{receta}/{cita}', 'DetalleRecetaController@create')->name('detalleReceta.create')->middleware('permission:recetas.create');

	Route::put('detalleReceta/update/{detalle}', 'DetalleRecetaController@update')->name('detalleReceta.update')->middleware('permission:admin.editarHistoria');

	Route::get('detalleReceta/edit/{receta}/{detalle}/{cita}', 'DetalleRecetaController@edit')->name('detalleReceta.edit')->middleware('permission:detalleRecetas.edit');

	Route::delete('detalleReceta/destroy/{detalle}', 'DetalleRecetaController@destroy')->name('detalleReceta.destroy')->middleware('permission:admin.eliminarHistoria');


	//Recetas
	Route::post('pago/store', 'PagoController@store')->name('pago.store')->middleware('permission:recetas.create');

	Route::get('pago/{cita}/', 'PagoController@index')->name('pago.index')->middleware('permission:recetas.index');

	Route::get('pago/create/{cita}/', 'PagoController@create')->name('pago.create')->middleware('permission:recetas.create');

});
