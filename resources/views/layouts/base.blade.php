<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>

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

    <!-- Full Calendar -->
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
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
  </style>
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
 
      <a class="navbar-brand mr-1" href="/home">Clinica Odontologica YekixPaki</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Navbar -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                            </li>
                            <li class="nav-item">
                            </li>
                        @else
                            <li class="nav-item ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
            </div>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/home">
            <i class="fa fa-home"></i>
            <span>Inicio</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class=" fa fa-folder-open"></i>
            <span>Calendario</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/events">Citas</a>
          </div>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/home">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>

          <!-- Page Content -->
          <div>
                <nav class="navbar navbar-expand-sm bg-info navbar-dark">
                <ul class="navbar-nav">
                  @can('procedimientos.index')
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('procedimiento.index')}}">Procedimientos</a>
                    </li>
                  @endcan
                  @can('users.index')
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.index')}}">Doctores</a>
                    </li>
                  @endcan
                  @can('users.asistente')
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.asistente')}}">Asistente</a>
                    </li>
                  @endcan
                  @can('pacientes.index')
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('paciente.index')}}">Pacientes</a>
                    </li>
                  @endcan
                  @can('roles.index')
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                    </li>
                  @endcan
                </nav>
          </div>
          @if(session('info'))
          <div>
            <div class="row">
              <div class="col-md-12 col-md-offset-2">
                <div class="alert alert-success">
                  {{session('info')}}
                </div>
              </div>
            </div>
          </div>
          @endif
          @yield('content')
          
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Clinica Dental de Atencion Integral y Preventiva Yekixpaki 2018 </span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
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
