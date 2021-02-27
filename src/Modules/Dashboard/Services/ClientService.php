<?php

namespace Modules\Dashboard\Services;


use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class ClientService extends BaseService
{
    public function paginate(Company $company, Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per-page');
        return $company
            ->clients()
            ->with('wallet')
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
}
