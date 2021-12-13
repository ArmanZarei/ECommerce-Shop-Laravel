<?php

namespace App\Channels;

use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

// TODO: This is not a general purpose channel for SMS. Make changes...
class SMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $code = $notification->toSMS();

        $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
        $api->verify(
            $notifiable->cellphone,
            1,
            "OTPSms",
            $code,
        );
    }
}
