<?php

namespace Modules\Dashboard\Services;


use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;


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
        $filteredData = Arr::only($data, ['name', 'email', 'status']);
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
        return $client->transactions()->latest()->paginate($perPage);
    }

    public function getLatestTransactions(Client $client, int $latest = 10): Collection
    {
        return $client->transactions()->take($latest)->latest()->get();
    }

    public function checkSubscription(Client $client)
    {
        if($client->isActive()){
            if($client->hasSubscriptionExpired()){
                $client->forceWithdraw($client->company->getPricePerMonth() * 100,
                    [
                        'description' => $client->company->getName()
                    ]
                );
                $client->calculateNextLeftDays();
            } else {
                $client->decreaseLeftDays();
            }
        }
    }

    public function nextPaymentAt(Company $company, Client $client): string
    {
        $pricePerMonth = $company->getPricePerMonth();
        $userBalance = $client->balance / 100;
        $leftDays = $client->getLeftDays();
        $monthsRemaining = abs(($userBalance / $pricePerMonth));
        $shiftByDays = 0;

        if($userBalance >= 0){
            $shiftByDays += $leftDays;
        }

        $monthsWithoutRemainder = intval(floor($monthsRemaining));
        if($monthsWithoutRemainder > 0){
            $shiftByDays += Carbon::now()->addMonths($monthsWithoutRemainder)->diffInDays();
        }

        $remainderDays = $monthsRemaining - $monthsWithoutRemainder;
        if($remainderDays > 0){
            $daysInMonth = Carbon::now()->addMonths($monthsWithoutRemainder)->daysInMonth;
            $shiftByDays += intval(floor($daysInMonth * $remainderDays));
        }

        switch (true){
            case ($userBalance > 0):
                return Carbon::now()
                    ->addDays(intval($shiftByDays))
                    ->diffForHumans(null, true, false, 2);
            case $userBalance < 0:
                return Carbon::now()->subDays(intval($shiftByDays))->diffForHumans();
            default:
                return ($leftDays > 0)
                    ? Carbon::now()
                        ->addDays(intval($shiftByDays))
                        ->diffForHumans(null, true, false, 1)
                    : trans('shared.today');
        }
    }
}
