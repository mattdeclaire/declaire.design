<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
    {
        return view('homepage', [
            'testimonials' => [
                ['name' => "The Murrays", 'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor corporis possimus totam eligendi officia laboriosam sed ut ex esse, numquam soluta pariatur repudiandae dolorem a illo, officiis sint assumenda repellat."],
                ['name' => "The Murrays", 'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor corporis possimus totam eligendi officia laboriosam sed ut ex esse, numquam soluta pariatur repudiandae dolorem a illo, officiis sint assumenda repellat."],
                ['name' => "The Murrays", 'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor corporis possimus totam eligendi officia laboriosam sed ut ex esse, numquam soluta pariatur repudiandae dolorem a illo, officiis sint assumenda repellat."],    
            ],
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function portfolio()
    {
        return view('portfolio');
    }

    public function process()
    {
        return view('process');
    }

    public function contact()
    {
        return view('contact');
    }
}
