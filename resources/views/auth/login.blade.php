@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h1 class="h3 font-weight-normal">Inicio de Sesion</h1>
        </div>
    </div>
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" autocomplete="off">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <label for="name" class="btn-block" >
                                    <i class="btn btn-dark btn-block disabled">
                                        <span class="fa fa-user-o">
                                            {{ __('Nombre de Usuario:') }}
                                        </span>
                                    </i>
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br />
                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <label for="name" class="btn-block">
                                    <i class="btn btn-dark btn-block disabled">
                                            <span class="fa fa-lock">
                                                {{ __('Contraseña:') }}
                                            </span>
                                    </i>
                                </label>
                            </div>
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

                        <div class="form-row justify-content-center">
                            <div c  lass="col-md-10 text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Iniciar Sesion') }}
                                </button>
                            </div>
                            <div class="col-md-12 text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Olvidaste la Contraseña?') }}
                                </a>
                            </div>
                        </div>
                    </form>
@endsection
