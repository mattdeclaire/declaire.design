@extends('layout')
@section('content')

    <x-section id="home-banner">
        <h1>Experience professional design every day in your own home.</h1>
    </x-section>

    <x-section id="about">
        <h2>I'm Katie DeClaire.</h2>
        <p>I'm an interior designer in the San Francisco Bay Area, specializing in home furnishings and decor. With my background in merchandising, I can help you transform your home into a space you love to come home to every day.</p>
    </x-section>

    <x-section id="testimonials">
        @foreach($testimonials as $testimonial)
            <blockquote>
                <p>{{$testimonial['content']}}</p>
                <cite>{{$testimonial['name']}}</cite>
            </blockquote>
        @endforeach
    </x-section>

    <x-section id="home-contact">
        <p>Reach out today, and let's get started.</p>
        <a href="/contact" class="btn">Contact Me</a>
    </x-section>

@endsection