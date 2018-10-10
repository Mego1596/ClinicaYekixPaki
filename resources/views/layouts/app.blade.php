<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Yekixpaki</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" align="center">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="col-md-12 col-sm-12">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Clinica Dental de Atencion
                </a>
                <a class="navbar-brand" href="{{ url('/') }}">
                    Integral y Preventiva Yekixpaki
                </a>
            </div>
        </nav>
    </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
