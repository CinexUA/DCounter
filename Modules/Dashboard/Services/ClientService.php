<?php

namespace Modules\Dashboard\Services;


use App\Models\Client;
use App\Models\Company;
use App\Models\CronLog;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Dashboard\Notifications\DepositedBalanceNotification;


class ClientService extends BaseService
{
    public function paginate(Company $company, Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per-page');
        return $company
            ->clients()
            ->with(['company.currency', 'wallet'])
            ->filter($request->all())
            ->sortable()
            ->paginateFilter($perPage);
    }

    public function create(Company $company, array $data): Client
    {
        $data = Arr::add($data, 'remember_token', sha1(time()));
        /** @var $client Client */
        $client = $company->clients()->create($data);
        return $client;
    }

    public function update(Client $client, array $data): Client
    {
        $filteredData = Arr::except($data, ['password']);
        $client->update($filteredData);

        if(!empty($data['password'])){
            $client->update(['password' => $data['password']]);
        }

        return $client;
    }

    public function countOwnClients(): int
    {
        $id = auth()->id();

        return Client::whereHas('company', function ($q) use($id) {
            $q->select('id')->where('organizer_id', $id);
        })->count();
    }

    public function makeTransaction(
        Client $client,
        float $amount,
        ?string $description,
        bool $deposit = true): Client
    {
        $client->load('company.currency');

        if($deposit){
            $client->deposit($amount, [
                'description' => $description, 'currency' => $client->company->currency->getName()
            ]);

            if($client->company->isEnabledSmsNotification() && !empty($client->phone)){
                $amountPrecision = intval($amount / 100);
                $client->notify(
                    new DepositedBalanceNotification($client, $amountPrecision, $client->company->getName())
                );
            }

        } else {
            $client->forceWithdraw($amount, [
                'description' => $description, 'currency' => $client->company->currency->getName()
            ]);
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

    public function checkActiveSubscription(Client $client)
    {
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

    public function isTimePassedSinceLastLaunchCron(int $hours = 24): bool
    {
        $latestCron = CronLog::whereType('subscription')->latest()->first();
        if($latestCron){
            return Carbon::now()->diffInHours($latestCron->created_at) >= $hours;
        }
        return true;
    }

    public function insertCronLogInfoAboutCheckSubscriptionResult(): void
    {
        CronLog::create(
            [
                'description' => 'check of subscription & write-off of funds if the subscription has expired',
                'type' => 'subscription'
            ]
        );
    }

    /**
     * @param Company $company
     * @param Client $client
     * @param bool $withHumanDate
     * @return string
     */
    public function nextPaymentAt(Company $company, $client, $withHumanDate = false): string
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
            $shiftByDays += Carbon::now()->addMonthsNoOverflow($monthsWithoutRemainder)->diffInDays();
        }

        $remainderDays = $monthsRemaining - $monthsWithoutRemainder;
        if($remainderDays > 0){
            $daysInMonth = Carbon::now()->addMonthsNoOverflow($monthsWithoutRemainder)->daysInMonth;
            $shiftByDays += intval(floor($daysInMonth * $remainderDays));
        }

        switch (true){
            case ($userBalance > 0):
                return $this->formatDateByShiftDays($shiftByDays, $withHumanDate);
            case $userBalance < 0:
                return Carbon::now()->subDays(intval($shiftByDays))->diffForHumans();
            default:
                return ($leftDays > 0)
                    ? $this->formatDateByShiftDays($shiftByDays, $withHumanDate)
                    : trans('shared.today');
        }
    }

    private function formatDateByShiftDays(int $shiftDays, $withHumanDate = false)
    {
        $date = Carbon::now()->addDays(intval($shiftDays));
        if($withHumanDate){
            return sprintf(
                '%s (~%s)',
                $date->format('d.m.Y'),
                $date->diffForHumans(
                    null,
                    CarbonInterface::DIFF_RELATIVE_TO_NOW,
                    false,
                    2
                )
            );
        } else {
            return $date->format('d.m.Y');
        }
    }
}
