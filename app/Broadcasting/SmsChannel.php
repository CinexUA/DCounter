<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toSms')) {
            $notification->toSms();
        } else {
            return;
        }

        return true;
    }
}
