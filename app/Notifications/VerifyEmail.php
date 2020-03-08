<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
//    use Queueable;

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $prefix = config('frontend.url') . config('frontend.email_verify_url');
        $temporarySignedURL = URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(10), ['id' => $notifiable->getKey()]
        );

        // I use urlencode to pass a link to my frontend.
        return $prefix . urlencode($temporarySignedURL);
    }
}
