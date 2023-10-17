<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\ValidationRule;

class RecaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ])->json();

        if (!$recaptcha['success']) {
            Log::info("failed recaptcha", [
                'errors' => $recaptcha['error-codes'],
            ]);

            $fail("We've encountered an error. Please try again later.");
        } else if ($recaptcha['score'] < 0.5) {
            $fail("something went wrong");
        }
    }
}
