<?php

namespace App\Http\Controllers;

use App\Rules\RecaptchaRule;
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
            'recaptcha' => new RecaptchaRule,
        ]);

        // TODO: save to DB, and send to self

        return back()->with('message-sent', true);
    }

}
