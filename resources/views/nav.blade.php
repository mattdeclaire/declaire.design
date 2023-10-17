<nav id="site-nav">
    {{-- mobile toggle and hamburger --}}
    <input type="checkbox" id="nav-toggle" />
    <span class="mobile-hamburger"></span>
    <span class="mobile-hamburger"></span>
    <span class="mobile-hamburger"></span>

    <ol>
        {{-- <li><a href="/">Home</a></li> --}}
        {{-- <li><a href="/about">About</a></li> --}}
        {{-- <li><a href="/portfolio">Portfolio</a></li> --}}
        {{-- <li><a href="/process">Process</a></li> --}}
        <li><a href="mailto:{{ config('mail.contact') }}" target="_blank" class="btn">Contact</a></li>
    </ol>
</nav>
