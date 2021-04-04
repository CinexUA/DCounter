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
    private $balance;
    private $companyName;

    public function __construct(Client $client, string $balance, string $companyName)
    {
        $this->client = $client;
        $this->balance = $balance;
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
            'balance' => $this->balance.$this->client->company->currency->getName(),
            'company' => $this->companyName,
        ]);
    }
}
