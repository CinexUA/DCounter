<?php

namespace Modules\Client\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->getName(),
            'token' => $this->remember_token,
            'provider' => $this->company->name,
        ];
    }
}
