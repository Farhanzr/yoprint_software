<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

        <title>YoPrint</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('img/power_button.png')}}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}"> --}}
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">

        <!-- Scripts -->
        {{-- <script src="{{ url(mix('js/app.js')) }}" defer></script> --}}
        <script src="{{ asset('dist/js/app.js') }}"></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    </head>

    <body>
        @yield('body')

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                offset:400,
                duration :1000
            });
        </script>
    </body>
</html>
