<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Currency;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Http\Requests\CurrencyRequest;
use Modules\Dashboard\Services\CurrencyService;
use Modules\Dashboard\Services\LanguageService;

class CurrenciesController extends BaseController
{
    private $currencyService;
    private $languageService;

    public function __construct(CurrencyService $currencyService, LanguageService $languageService)
    {
        $this->authorizeResource(Currency::class);
        $this->currencyService = $currencyService;
        $this->languageService = $languageService;
    }

    public function index(Request $request)
    {
        $currencies = $this->currencyService->paginate($request);
        return view('dashboard::currencies.index', compact('currencies'));
    }

    public function create()
    {
        $languages = $this->languageService->languagesKeysList();
        return view('dashboard::currencies.create', compact('languages'));
    }

    public function store(CurrencyRequest $currencyRequest)
    {
        $this->currencyService->create($currencyRequest->validated());
        toastr()->success(__("Currency created"));

        return redirect()->route('dashboard.admin.currencies.index');
    }

    public function show(Currency $currency)
    {
        $languages = $this->languageService->languagesKeysList();
        return view('dashboard::currencies.show', compact('currency', 'languages'));
    }

    public function edit(Currency $currency)
    {
        $languages = $this->languageService->languagesKeysList();
        return view('dashboard::currencies.edit', compact('currency', 'languages'));
    }

    public function update(CurrencyRequest $currencyRequest, Currency $currency)
    {
        $this->currencyService->update($currency, $currencyRequest->validated());
        toastr()->success(__("Currency updated"));

        return redirect()->route('dashboard.admin.currencies.edit', $currency);
    }

    public function destroy(Currency $currency)
    {
        if($this->currencyService->canDelete($currency)){
            $currency->delete();
            toastr()->success(__("Currency has been deleted"));
            return response()->json(['message' => null, 'success' => true], 204);
        } else {
            toastr()->warning(__("Currency can't be deleted because it has relations"));
            return response()->json(['message' => null, 'success' => false], 403);
        }
    }
}
