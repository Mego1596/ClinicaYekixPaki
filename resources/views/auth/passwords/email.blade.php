@extends('layouts.app')
@section('card-header')
    <div class="col-md-2 col-sm-12">
        <a href="{{route('login')}}" class="btn btn-block btn-secondary" style="width: 100%">
            <li class="fa fa-arrow-circle-left"></li> Atrás</a>
    </div>
    <div class="col-md-8" align="center">
        <a class="navbar-brand" href="{{ url('/') }}">Clinica Dental de Atencion</a>
        <a class="navbar-brand" href="{{ url('/') }}">Integral y Preventiva Yekixpaki</a>
    </div>
@endsection
@section('content')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group" align="center">
                            <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail') }}</label>

                            <div class="col-md-5 col-sm-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" align="center">
                            <div class="col-md-5 col-sm-12">
                                <button type="submit" class="btn btn-success" style="width: 100%">
                                    {{ __('Restablecer de Contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>
@endsection
