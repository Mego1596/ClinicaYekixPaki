@extends('layouts.app')
@section('content')

    <div class="col-md-8" style="text-align: center;">
        <h3>Inicio de Sesion</h3>
        <br />
    </div>
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" autocomplete="off">
                        @csrf

                        <div class="form-row" style="text-align: center;">
                                <label for="name" class="col-sm-6 col-form-label text-md-right" >
                                    <i class="btn btn-sm btn-dark disabled">
                                        <span class="fa fa-user-o"> 
                                            {{ __('Nombre de Usuario:') }}
                                        </span>
                                    </i>
                                </label>
                            <div class="col-md-6 col-sm-12" align="center">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br />
                        <div class="form-row" style="text-align: center;">
                            <label for="name" class="col-sm-6 col-form-label text-md-right">
                                    <i class="btn btn-sm btn-dark disabled">
                                        <span class="fa fa-lock"> 
                                            {{ __('Contraseña:') }}
                                        </span>
                                    </i>
                                </label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br />

                        <div class="form-row">
                            <div class="col-md-7 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesion') }}
                                </button>
                            </div>
                            <div class="col-md-12 offset-md-3">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Olvidaste la Contraseña?') }}
                                </a>
                            </div>
                        </div>
                    </form>
@endsection
