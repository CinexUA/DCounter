<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Http\Requests\CompanyRequest;
use Modules\Dashboard\Services\CompanyService;

class CompaniesController extends BaseController
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->authorizeResource(Company::class);
        $this->companyService = $companyService;
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
        return view('dashboard::companies.create');
    }

    public function store(CompanyRequest $companyRequest)
    {
        $this->companyService->create($companyRequest->validated());
        toastr()->success(__("Company created"));
        return redirect()->route('dashboard.companies.index');
    }

    public function edit(Company $company)
    {
        return view('dashboard::companies.edit', compact('company'));
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
}
