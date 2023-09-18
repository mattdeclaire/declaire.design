@extends('layout')
@section('title', "Contact")
@section('content')

    <x-section>
        <h1>Contact me.</h1>

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
                    placeholder="How id you hear about me?"
                    class="@error('referrer') invalid @enderror"
                    value="{{old('referrer')}}"
                /><br>

                <textarea
                    name="message"
                    placeholder="How can I help you?"
                    class="@error('message') invalid @enderror"
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
    </x-section>

@endsection