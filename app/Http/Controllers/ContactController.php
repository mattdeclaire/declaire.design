<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required_without:email',
            'email' => '',
            'referrer' => '',
            'message' => '',
        ]);

        // TODO: recaptcha

        // TODO: Send to self, save in DB;

        return back()->with('message-sent', true);
    }

}
