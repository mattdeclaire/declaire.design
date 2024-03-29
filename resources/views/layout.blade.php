<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', "DeClaire Design")</title>

        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google-analytics.key') }}"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '{{ config('services.google-analytics.key') }}');
        </script>

        @vite(['resources/css/site.css', 'resources/js/site.js'])

        {{-- <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key')}}"></script> --}}
        {{-- <meta name="recaptcha_key" content="{{ config('services.recaptcha.key')}}"> --}}
    </head>
    <body>
        <header>
            <div id="header-content">
                <a href="/" id="logo">
                    <img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="DeClaire Design" width="188" height="80" />
                </a>
                @include('nav')
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            &copy;{{date('Y')}}. DeClaire Design. All Rights Reserved.
        </footer>
    </body>
</html>
