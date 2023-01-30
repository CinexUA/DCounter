<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\ClientVisiting;
use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Http\Requests\CompanyRequest;
use Modules\Dashboard\Services\CompanyService;
use Modules\Dashboard\Services\CurrencyService;

class CompaniesController extends BaseController
{
    private $companyService;
    private $currencyService;

    public function __construct(CompanyService $companyService, CurrencyService $currencyService)
    {
        $this->authorizeResource(Company::class);
        $this->companyService = $companyService;
        $this->currencyService = $currencyService;
    }

    public function index(Request $request): Renderable
    {
        $companies = $this->companyService->paginate($request);
        return view('dashboard::companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        return view('dashboard::companies.show', compact('company'));
    }

    public function create()
    {
        $currencies = $this->currencyService->selectList();
        return view('dashboard::companies.create', compact('currencies'));
    }

    public function store(CompanyRequest $companyRequest)
    {
        $this->companyService->create($companyRequest->validated());
        toastr()->success(__("Company created"));
        return redirect()->route('dashboard.companies.index');
    }

    public function edit(Company $company)
    {
        $currencies = $this->currencyService->selectList();
        return view('dashboard::companies.edit', compact('company', 'currencies'));
    }

    public function update(CompanyRequest $companyRequest, Company $company)
    {
        $this->companyService->update($company, $companyRequest->validated());
        toastr()->success(__("Company has been updated"));
        return redirect()->back();
    }

    public function destroy(Company $company)
    {
        $company->delete();
        toastr()->success(__("Company has been deleted"));
        return response()->json(['message' => null, 'success' => true], 204);
    }

    public function visitingCustomers(Company $company, Request $request)
    {
        abort_if(!$company->visiting_clients_log, 403);
        $this->authorize('view', $company);

        $visitingList = $this->companyService->getVisitingList($company, $request);

        return view('dashboard::companies.visiting_customers.index', compact('company','visitingList'));
    }

    public function clearVisitingList(Company $company)
    {
        abort_if(!$company->visiting_clients_log, 403);
        $this->authorize('view', $company);

        $this->companyService->clearVisitingList($company);

        toastr()->success(__("Company history of client visits has been deleted"));

        return response()->json(['message' => null, 'success' => true], 204);
    }
}
