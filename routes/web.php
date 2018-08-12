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
	Route::post('procedimiento/store', 'ProcedimientoController@store')->name('procedimiento.store')->middleware('permission:procedimiento.create');

	Route::get('procedimiento', 'ProcedimientoController@index')->name('procedimiento.index')->middleware('permission:procedimiento.index');

	Route::get('procedimiento/create', 'ProcedimientoController@create')->name('procedimiento.create')->middleware('permission:procedimiento.create');

	Route::put('procedimiento/{procedimiento}', 'ProcedimientoController@update')->name('procedimiento.update')->middleware('permission:procedimiento.edit');

	Route::get('procedimiento/{procedimiento}', 'ProcedimientoController@show')->name('procedimiento.show')->middleware('permission:procedimiento.show');

	Route::delete('procedimiento/{procedimiento}', 'ProcedimientoController@destroy')->name('procedimiento.destroy')->middleware('permission:procedimiento.destroy');

	Route::get('procedimiento/edit/{procedimiento}', 'ProcedimientoController@edit')->name('procedimiento.edit')->middleware('permission:procedimiento.edit');


	//Usuarios
	Route::post('user/store', 'UserController@store')->name('user.store')->middleware('permission:user.create');

	Route::get('user', 'UserController@index')->name('user.index')->middleware('permission:user.index');

	Route::get('user/create', 'UserController@create')->name('user.create')->middleware('permission:user.create');

	Route::put('user/{user}', 'UserController@update')->name('user.update')->middleware('permission:user.edit');
	
	Route::get('user/{user}', 'UserController@show')->name('user.show')->middleware('permission:user.show');

	Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy')->middleware('permission:user.destroy');

	Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit')->middleware('permission:user.edit');
});
