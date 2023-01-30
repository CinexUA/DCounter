<?php

namespace Modules\Dashboard\Services;


use App\Models\Currency;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class CurrencyService extends BaseService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per-page');
        return Currency::paginate($perPage);
    }

    public function create(array $data): Currency
    {
        return Currency::create($data);
    }

    public function update(Currency $currency, array $data): Currency
    {
        $currency->update($data);
        return $currency;
    }

    public function selectList(): array
    {
        return Currency::pluck('name', 'id')->toArray();
    }

    public function canDelete(Currency $currency): bool
    {
        return (!$currency->companies()->exists());
    }
}
