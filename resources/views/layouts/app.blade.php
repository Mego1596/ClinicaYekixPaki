<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Yekixpaki</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card  mx-auto mt-5">
        <div class="card-header">
          <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            @yield('card-header')
          </nav>
        </div>
        <div class="card-body">
          @yield('content')
        </div>
      </div>
    </div>

  </body>

</html>
