<?php

namespace Modules\Dashboard\Notifications;

use App\Services\Sms\Facades\Sms;
use App\Services\Sms\SmsBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NegativeBalance extends Notification
{
    use Queueable;

    private $phone;
    private $balance;
    private $company;

    public function __construct(string $phone, string $balance, string $company)
    {
        $this->phone = $phone;
        $this->balance = $balance;
        $this->company = $company;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['sms'];
    }

    public function toSms()
    {
        $sms = new SmsBuilder();
        $sms->setTo($this->phone);
        $sms->setMessage($this->prepareMessage());

        Sms::send($sms);
    }

    private function prepareMessage(): string
    {
        return trans('dashboard::shared.negative_balance_on_your_account',[
            'balance' => $this->balance,
            'company' => $this->company,
        ]);
    }
}
