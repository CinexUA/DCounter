<?php

namespace Modules\Dashboard\Services;


use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class ClientService extends BaseService
{
    public function paginate(Company $company, Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per-page');
        return $company
            ->clients()
            ->with(['company', 'wallet'])
            ->filter($request->all())
            ->sortable()
            ->paginateFilter($perPage);
    }

    public function create(Company $company, array $data): Client
    {
        /** @var $client Client */
        $client = $company->clients()->create($data);
        return $client;
    }

    public function update(Client $client, array $data): Client
    {
        $filteredData = Arr::only($data, ['name', 'email']);
        $client->update($filteredData);

        if(!empty($data['password'])){
            $client->update(['password' => $data['password']]);
        }

        return $client;
    }

    public function makeTransaction(
        Client $client,
        float $amount,
        ?string $description,
        bool $deposit = true): Client
    {
        if($deposit){
            $client->deposit($amount, ['description' => $description]);
        } else {
            $client->forceWithdraw($amount, ['description' => $description]);
        }
        return $client;
    }

    public function getTransactions(Client $client): Collection
    {
        return $client->transactions;
    }

    public function getPaginateTransactions(Client $client, ?int $perPage = 15): LengthAwarePaginator
    {
        return $client->transactions()->paginate($perPage);
    }

    public function getLatestTransactions(Client $client, int $latest = 10): Collection
    {
        return $client->transactions()->take($latest)->latest()->get();
    }

}
