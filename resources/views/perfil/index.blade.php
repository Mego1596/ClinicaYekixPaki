@extends('layouts.base')
@section('content')
<div class="tile user-settings">
    <h4 class="line-head">Su perfil</h4>
    <form>
      <div class="row mb-4">
        <div class="col-md-4">
          <label>Nombres</label>
        <input class="form-control" type="text" readonly value="{{$user->nombre1.' '.$user->nombre2}}">
        </div>
        <div class="col-md-4">
          <label>Apellidos</label>
          <input class="form-control" type="text" readonly value="{{$user->apellido1.' '.$user->apellido2}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label>Email</label>
        <input class="form-control" type="text" readonly value="{{$user->email}}">
        </div>

        <div class="col-md-4">
          <label>Nombre de usuario</label>
        <input class="form-control" type="text" readonly value="{{$user->name}}">
        </div>

        <div class="col-md-4">
        @if($rol->name!=='Paciente')
        <label>Rol</label>
          <input class="form-control" type="text"  readonly value={{$rol->name}}>
        </div>
        @endif
      </div>
      <div class="row mb-10">

      </div>
    </form>
  </div>

  <br> 
  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Cambiar contraseña <i class='fa fa-lock'></i></button>
  <form method="POST" action='{{route('perfil.password')}}'>
      {{ csrf_field() }}

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

   
      <div class="modal-body">


          <div class="form-group">
            <label for="message-text" class="col-form-label">Contraseña actual:</label>
            <input class="form-control" id="message-text" name='actual' type='password'>
          </div>
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Contraseña nueva:</label>
              <input type="password" class="form-control" name='nueva' id="recipient-name">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-success" id="btnAgregar" name="btnAgregar"  type="submit" value='Guardar'>   </div>
    </div>
  </div>
</div>
</form>
  @endsection
