<?php

namespace Modules\Dashboard\Services;


use App\Models\Client;
use App\Models\ClientVisiting;
use App\Models\Company;
use App\Models\CronLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Dashboard\Notifications\NegativeBalanceNotification;


class CompanyService extends BaseService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per-page');
        return Auth::user()
            ->companies()
            ->with('organizer', 'currency')
            ->filter($request->all())
            ->sortable()
            ->paginateFilter($perPage);
    }

    public function create(array $data): Company
    {
        $company = new Company($data);
        $company->organizer()->associate(auth()->user());
        $company->save();
        return $company;
    }

    public function update(Company $company, array $data)
    {
        $company->update($data);
        return $company;
    }

    public function getVisitingList(Company $company, Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per-page');
        $clientsIds = $company->clients()->pluck('id')->toArray();
        return ClientVisiting::whereIn('client_id', $clientsIds)
            ->with('client')
            ->latest()
            ->paginate($perPage);
    }

    public function clearVisitingList(Company $company): void
    {
        $clientsIds = $company->clients()->pluck('id')->toArray();
        ClientVisiting::whereIn('client_id', $clientsIds)->delete();
    }

    public function notifyingUsersOfNegativeBalance()
    {
        Client::whereNotNull('phone')
            ->whereHas('company', function ($q){
                $q->select('id')->where('sms_notification', 1);
            })
            ->whereHas('wallet', function ($q){
                $q->select('id')->where('balance', '<', 0);
            })
            ->with('company.currency')
            ->chunk(50, function ($clients){
                foreach ($clients as $client) {
                    $client->notify(
                        new NegativeBalanceNotification($client, $client->balanceFloat, $client->company->getName())
                    );
                }
            });
    }

    public function insertCronLogNegativeBalanceNotifyResult(): void
    {
        CronLog::create(
            [
                'description' => 'negative balance check and notification',
                'type' => 'negative_balance_notify'
            ]
        );
    }
}
