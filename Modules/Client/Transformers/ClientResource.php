<?php

namespace Modules\Client\Transformers;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Dashboard\Services\ClientService;

class ClientResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Client $client */
        $client = $this;
        return [
            'id' => $client->getKey(),
            'name' => $client->getName(),
            'remember_token' => $client->remember_token,
            'provider' => $client->company->getName(),
            'provider_price' => $client->company->getPricePerMonthFormatted(),
            'left_days' => $client->getLeftDays(),
            'balance' => $client->balance,
            'currency' => $client->company->currency->getName(),
            'colorize_balance' => $client->colorizeBalance(true),
            'is_active' => $client->isActive(),
            'status_as_badge' => $client->getStatusAsBadge(),
            'next_payment_humans' => app(ClientService::class)->nextPaymentAt($this->company, $client)
        ];
    }
}
