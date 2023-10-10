<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name'))</title>
        @vite(['resources/css/site.css', 'resources/js/site.js'])
    </head>
    <body>
        <header>
            <div id="header-content">
                <a href="/" id="logo">DeClaire Design</a>

                <nav id="site-nav">
                    <!-- mobile toggle and hamburger -->
                    <input type="checkbox" id="nav-toggle" />
                    <span class="mobile-hamburger"></span>
                    <span class="mobile-hamburger"></span>
                    <span class="mobile-hamburger"></span>

                    <ol>
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/portfolio">Portfolio</a></li>
                        <li><a href="/process">Process</a></li>
                        <li><a href="/contact" class="btn">Contact</a></li>
                    </ol>
                </nav>
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
