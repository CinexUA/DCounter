<?php

namespace Modules\Dashboard\Notifications;

use App\Models\Client;
use App\Services\Sms\Facades\Sms;
use App\Services\Sms\SmsBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DepositedBalanceNotification extends Notification
{
    use Queueable;

    private $client;
    private $sum;
    private $companyName;

    public function __construct(Client $client, string $sum, string $companyName)
    {
        $this->client = $client;
        $this->sum = $sum;
        $this->companyName = $companyName;

        if(!empty($client->preferred_language)){
            app()->setLocale($client->preferred_language);
        }
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
        $sms->setTo($this->client->getPhone());
        $sms->setMessage($this->prepareMessage());

        Sms::send($sms);
    }

    private function prepareMessage(): string
    {
        return trans('dashboard::shared.on_your_account_deposited', [
            'sum' => $this->sum.$this->client->company->currency->getName(),
            'balance' => $this->client->wallet->getBalanceFloatAttribute(),
            'company' => $this->companyName,
        ]);
    }
}
