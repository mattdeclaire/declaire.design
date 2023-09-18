@extends('layout')
@section('content')

    <x-section id="home-banner">
        <x-card>
            <h1>Welcome to DeClaire Design.</h1>
            <p>We're here to help.</p>
        </x-card>
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