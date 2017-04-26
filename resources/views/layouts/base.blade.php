<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Asap:400,400i,500,700|Pacifico" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        var split = new Date().toString().split(" ");
        var timeZoneFormatted = split[split.length - 2];
        
        document.cookie = "timezone=" + timeZoneFormatted;
        
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <header>
        <nav class="main-nav text-center">
            <div class="container">
                @if(!Auth::check())
                <span><a href="/login">Login</a></span>
                <span><a href="/register">Register</a></span>
                @else
                <span class="uname">Welcome, {{ Auth::user()->name }}</span>
                @endif
                @if(Auth::check())
                <span><a href="/sources">Your Sources</a></span>
                @endif
                <span><a href="#">How it works</a></span>
                @if(Auth::check())
                <span><a href="/logout">Logout</a>
                @endif
            </div>
        </nav>
        <div class="container text-center">
            <a href="/" class="logo">Simply News</a>
        </div>
    </header>
    <div id="app">
        @yield('content')
    </div>
    <footer>
        <div class="container text-center">
            Made by <a href="http://eastoh.co" target="_blank">Eric Miller</a>
        </div>
    </footer>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
