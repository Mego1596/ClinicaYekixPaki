<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">          
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>YekixPaki</title>
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-clockpicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilos.css') }}">

    <!-- Full Calendar -->
    <!--<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    
    <!-- Full Calendar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fullcalendar.min.css') }}">
    <style type="text/css">
    .fc th{
      padding: 5px 0px;
      vertical-align: middle;
      background: #F2F2F2;
    }
    .fc-today {
    background: #eee !important;
    border: none !important;
    border-top: 1px solid #ddd !important;
    font-weight: bold;
    } 
    </style>
  {{-- iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @yield('javascript')
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ route('home') }}">
                <li class="fa fa-home"></li> Clinica Odontologica YekixPaki</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          @guest
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
            </li>
          @else
          @can('pacientes.trabajo')
            <li class="nav-item">
              <a class="nav-link" id="nav-citas" href="{{route('events.index')}}"><i class="fa fa-calendar"></i> Agenda</a>
            </li>
          @endcan
          @can('procedimientos.index')
            <li class="nav-item">
              <a class="nav-link" id="nav-procedimientos" href="{{route('procedimiento.index')}}"><i class="fa fa-list"></i> Procedimientos</a>
            </li>
          @endcan
          @can('users.index')
            <li class="nav-item">
              <a class="nav-link" id="nav-doctores" href="{{route('user.index')}}">
               <i class="fa fa-user-md"></i> Doctores</a>
            </li>
          @endcan
          @can('users.asistente')
            <li class="nav-item">
              <a class="nav-link" id="nav-asistentes" href="{{route('user.asistente')}}">
              <i class="fa fa-handshake-o"></i> Asistentes</a>
            </li>
          @endcan
          @can('pacientes.index')
            <li class="nav-item">
              <a class="nav-link" id="nav-pacientes" href="{{route('paciente.index')}}"><i class="fa fa-group"></i> Pacientes</a>
            </li>
          @endcan
          @can('roles.index')
            <li class="nav-item">
              <a class="nav-link" id="nav-roles" href="{{route('roles.index')}}">Roles</a>
            </li>
          @endcan
          @can('users.usuarios')
            <li class="nav-item">
              <a class="nav-link" id="nav-roles" href="{{route('user.usuario')}}"><i class="fa fa-cog"></i>Usuarios General</a>
            </li>
          @endcan
          </ul>


          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="fa fa-power-off"></i>    {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  {{ __('Cerrar Sesion') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li> 
          @endguest
        </ul>
      </div>
    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      {{-- @if(session('home')) --}}
      {{-- <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/home">
            <i class="fa fa-home"></i>
            <span>Inicio</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class=" fa fa-folder-open"></i>
            <span>Navegar</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            @can('pacientes.trabajo')
            <a class="dropdown-item" href="{{route('events.index')}}">Citas</a>
            @endcan

            @can('procedimientos.index')
            <a class="dropdown-item" href="{{route('procedimiento.index')}}">Procedimientos</a>
            @endcan

            @can('users.index')
            <a class="dropdown-item" href="{{route('user.index')}}">Doctores</a>
            @endcan

            @can('users.asistente')
            <a class="dropdown-item" href="{{route('user.asistente')}}">Asistente</a>
            @endcan

            @can('pacientes.index')
            <a class="dropdown-item" href="{{route('paciente.index')}}">Pacientes</a>
            @endcan

            @can('roles.index')
            <a class="dropdown-item" href="{{route('roles.index')}}">Roles</a>
            @endcan

          </div>
        </li>
      </ul> --}}
      {{-- @endif --}}

      <div  id="content-wrapper" class="container mb-3">

        <div class="container">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/home">Inicio</a>
            </li>
            @yield('bread')
          </ol>

          <!-- Page Content -->
          
          @if(session('info'))
          <div>
            <div class="row">
              <div class="col-md-12 pt-3">
                <div class="alert alert-success">
                  {{session('info')}}
                </div>
              </div>
            </div>
          </div>
          @endif
          @if(session('error'))
          <div>
            <div class="row">
              <div class="col-md-12 pt-3">
                <div class="alert alert-danger">
                  {{session('error')}}
                </div>
              </div>
            </div>
          </div>
          @endif
          @yield('content')
        </div>

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
      </div>
      <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Clinica Dental de Atencion Integral y Preventiva Yekixpaki 2018 </span>
            </div>
          </div>
        </footer>
      <!-- /.content-wrapper -->
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#">
      <i class="fa fa-angle-double-up"></i>
    </a>


<!--
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
-->

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js')}}"></script>

    <script src="{{ asset('js/eventos.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/es.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-clockpicker.js')}}"></script>
    <script>
      @yield('pageScript')
    </script>
    @yield('calendar')
  </body>

</html>
