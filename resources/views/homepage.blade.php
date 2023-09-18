@extends('layout')
@section('content')

    <x-section id="home-banner">
        <x-card>
            <h1>Welcome to DeClaire Design.</h1>
            <p>We're here to help.</p>
        </x-card>
    </x-section>

    <x-section>
        @foreach([
            ['name' => "The Murrays", 'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor corporis possimus totam eligendi officia laboriosam sed ut ex esse, numquam soluta pariatur repudiandae dolorem a illo, officiis sint assumenda repellat."],
            ['name' => "The Murrays", 'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor corporis possimus totam eligendi officia laboriosam sed ut ex esse, numquam soluta pariatur repudiandae dolorem a illo, officiis sint assumenda repellat."],
            ['name' => "The Murrays", 'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor corporis possimus totam eligendi officia laboriosam sed ut ex esse, numquam soluta pariatur repudiandae dolorem a illo, officiis sint assumenda repellat."],
        ] as $testimonial)
            <blockquote class="testimonial">
                <p>{{$testimonial['content']}}</p>
                <cite>{{$testimonial['name']}}</cite>
            </blockquote>
        @endforeach
    </x-section>
@endsection