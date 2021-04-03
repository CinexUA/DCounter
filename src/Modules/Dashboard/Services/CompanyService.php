<?php

namespace Modules\Dashboard\Services;


use App\Models\Client;
use App\Models\ClientVisiting;
use App\Models\Company;
use App\Models\CronLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Dashboard\Notifications\NegativeBalance;


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
        $companiesWithEnabledNotifications = Company::smsNotificationEnabled()->with('clients')->get();

        foreach ($companiesWithEnabledNotifications as $company){
            foreach ($company->clients as $client){

                if(!empty($client->phone) && $client->isNegativeBalance()){
                    $client->notify(new NegativeBalance($client, $client->balanceFloat, $company->getName()));
                }

            }
        }
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
