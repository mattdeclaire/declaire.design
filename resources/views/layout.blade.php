<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name'))</title>
        @vite(['resources/css/site.css', 'resources/js/site.js'])
        <script src="https://www.google.com/recaptcha/api.js"></script>
    </head>
    <body>
        <header>
            <div id="header-content">
                <a href="/" id="logo">DeClaire Design</a>
                @include('nav')
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            &copy;{{date('Y')}}. {{config('app.name')}}. All Rights Reserved.
        </footer>
    </body>
</html>
