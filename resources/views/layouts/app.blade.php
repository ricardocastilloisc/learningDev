<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

</head>
<body>
    <div id="app">

        @include('partials.navigation')


        <main class="py-4">
            <!--Esta parte es saber si existe la variable-->
            <!--el if lo que dice es que si existe esta variable hace eso-->
            @if (session('message'))
                <div class="row justify-content-center">
                    <div class="col-md-10">

                        <!--no se te olvide que el messange se encuentra en controlador y el controlador manda eso-->
                        <div class="alert alert-{{session('message')[0]}}">
                            <h4 class="alert-heading">{{__("Mensaje informativo")}}</h4>
                            <!--Este arreglo lo predefinimos en el ogin controller y sirve para poener el mensaje-->
                            <p>{{session('menssage')[1]}}</p>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
