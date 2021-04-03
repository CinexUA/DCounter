<?php

namespace Modules\Client\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'type' => $this->type,
            'amount' => $this->amount / 100,
            'currency' =>  $this->meta['currency'] ?? '',
            'description' => $this->meta['description'],
            'created_at' => $this->created_at,
            'created_at_human' => $this->created_at->diffForHumans(),
        ];
    }
}
