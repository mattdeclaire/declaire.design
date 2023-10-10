@extends('layout')
@section('title', "Contact")
@section('content')

    <x-section id="contact">
        <h1>Let's get started.</h1>

        @if (session('message-sent'))

            <p>Thanks so much. I'll get back to you as soon as I can.</p>

        @else

            <form method="post" action="/contact">
                @csrf

                <input
                    type="text"
                    name="name"
                    placeholder="name"
                    class="@error('name') invalid @enderror"
                    value="{{old('name')}}"
                /><br>

                <input
                    type="tel"
                    name="phone"
                    placeholder="phone"
                    class="@error('phone') invalid @enderror" 
                    value="{{old('phone')}}"
                /><br>

                <input
                    type="email"
                    name="email"
                    placeholder="email"
                    class="@error('email') invalid @enderror"
                    value="{{old('email')}}"
                /><br>

                <input
                    type="text"
                    name="referrer"
                    placeholder="How did you hear about me?"
                    class="@error('referrer') invalid @enderror"
                    value="{{old('referrer')}}"
                /><br>

                <textarea
                    name="message"
                    placeholder="How can I help you?"
                    class="@error('message') invalid @enderror"
                    rows="10"
                >{{old('message')}}</textarea><br>

                <button type="submit">Send</button>

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </form>

        @endif

        <p>Or if you'd prefer, you can send me an email at <a href="mailto:katie@declaire.design">katie@declaire.design</a>.</p>
    </x-section>

@endsection