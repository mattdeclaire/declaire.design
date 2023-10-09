@extends('layout')
@section('content')

    <x-section id="home-banner">
        <h1>Experience professional design every day in your own home.</h1>
    </x-section>

    <x-section>
        @foreach($testimonials as $testimonial)
            <blockquote class="testimonial">
                <p>{{$testimonial['content']}}</p>
                <cite>{{$testimonial['name']}}</cite>
            </blockquote>
        @endforeach
    </x-section>
@endsection