<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Http\Requests\ClientRequest;
use Modules\Dashboard\Services\ClientService;

class CompanyClientsController extends BaseController
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->authorizeResource(Client::class, null, ['except' => ['index']]);
        $this->clientService = $clientService;
    }

    public function index(Company $company, Request $request): Renderable
    {
        $this->authorize('view', $company);
        $clients = $this->clientService->paginate($company, $request);
        return view('dashboard::clients.index', compact('company', 'clients'));
    }

    public function show(Company $company, Client $client)
    {
        $latestTransactions = $this->clientService->getLatestTransactions($client, 5);
        return view('dashboard::clients.show', compact('company', 'client', 'latestTransactions'));
    }

    public function create(Company $company)
    {
        return view('dashboard::clients.create', compact('company'));
    }

    public function store(Company $company, ClientRequest $clientRequest)
    {
        toastr()->success(__("Client created"));
        $this->clientService->create($company, $clientRequest->validated());

        return redirect()->route('dashboard.company.clients.index', $company);
    }

    public function edit(Company $company, Client $client)
    {
        return view('dashboard::clients.edit', compact('company', 'client'));
    }

    public function update(Client $client, ClientRequest $clientRequest)
    {
        toastr()->success(__("Client has been updated"));
        $this->clientService->update($client, $clientRequest->validated());

        return redirect()->back();
    }

    public function destroy(Client $client)
    {
        toastr()->success(__("Client has been deleted"));
        $client->delete();
        return response()->json(['message' => null, 'success' => true], 204);
    }
}
