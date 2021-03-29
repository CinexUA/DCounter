<?php

namespace Modules\Client\Services;


use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;


class ClientService extends BaseService
{
    public function getClientsByTokens(array $tokens): Collection
    {
        $clients = Client::with('company')
            ->whereIn('remember_token', $tokens)
            ->get();

        foreach ($clients as $client){
            if($client->company->visiting_clients_log){
                $client->visiting()->create([
                    'description' => trans('shared.user_viewed_account')
                ]);
            }
        }

        return $clients;
    }
}
