<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SHLK') }}</title>
        <!-- Favicon -->
{{--        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">--}}
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        @yield('styles')

        <!-- Custom CSS -->
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="main-content">
            @include('layouts.navbars.navbar')
            <form action="{{ LaravelLocalization::getNonLocalizedURL() }}" method="POST" id="language-switcher" class="language-switcher">
                @csrf
                @method('GET')
                <select name="locale" onchange="document.getElementById('language-switcher').submit();">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <option value="{{ $localeCode }}" @if(App::getLocale() === $localeCode) selected @endif>{{ $properties['native'] }}</option>
                    @endforeach
                </select>
            </form>
            @yield('content')
        </div>

        @guest()

            @include('layouts.footers.guest')
        @endguest
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

    </body>
</html>
