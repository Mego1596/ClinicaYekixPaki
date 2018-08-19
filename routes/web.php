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
	Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('permission:roles.create');

	Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:roles.index');

	Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:roles.create');

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:roles.edit');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('permission:roles.show');

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:roles.destroy');

	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('permission:roles.edit');

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

	Route::get('user/create', 'UserController@create')->name('user.create')->middleware('permission:users.create');

	Route::put('user/{user}', 'UserController@update')->name('user.update')->middleware('permission:users.edit');
	
	Route::get('user/{user}', 'UserController@show')->name('user.show')->middleware('permission:users.show');

	Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy')->middleware('permission:users.destroy');

	Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit')->middleware('permission:users.edit');

	Route::get('asistente', 'UserController@asistentes')->name('user.asistente')->middleware('permission:users.asistente');

	//Full Calendar

	Route::get('events', 'EventsController@index')->name('events.index');
	Route::post('events', 'EventsController@addEvent')->name('events.add');

	//Pacientes
	Route::post('paciente/store', 'PacienteController@store')->name('paciente.store')->middleware('permission:pacientes.create');

	Route::get('paciente', 'PacienteController@index')->name('paciente.index')->middleware('permission:pacientes.index');

	Route::get('paciente/create', 'PacienteController@create')->name('paciente.create')->middleware('permission:pacientes.create');

	Route::put('paciente/{paciente}', 'PacienteController@update')->name('paciente.update')->middleware('permission:pacientes.edit');

	Route::get('paciente/{paciente}', 'PacienteController@show')->name('paciente.show')->middleware('permission:pacientes.show');

	Route::delete('paciente/{paciente}', 'PacienteController@destroy')->name('paciente.destroy')->middleware('permission:pacientes.destroy');

	Route::get('paciente/edit/{paciente}', 'PacienteController@edit')->name('paciente.edit')->middleware('permission:pacientes.edit');

	Route::get('paciente/{paciente}/events', 'PacienteController@agendar')->name('paciente.agenda');
	Route::post('paciente/events', 'PacienteController@addEvent')->name('paciente.add');

});
