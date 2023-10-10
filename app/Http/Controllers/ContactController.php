<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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

        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ])->json();

        if (!$recaptcha['success']) {
            Log::info("failed recaptcha", [
                'errors' => $recaptcha['error-codes'],
            ]);

            throw ValidationException::withMessages([
                '*' => "We've encountered an error. Please try again later.",
            ]);
        }

        // TODO: save to DB

        if ($recaptcha['score'] < 0.5) {
            throw ValidationException::withMessages([
                '*' => "something went wrong",
            ]);
        } else {
            // TODO: Send to self
        }

        return back()->with('message-sent', true);
    }

}
