<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $nextPaymentAsString = $this->clientService->nextPaymentAt($company, $client);
        $latestTransactions = $this->clientService->getLatestTransactions($client, 10);
        return view('dashboard::clients.show',
            compact(
                'company',
                'client',
                'latestTransactions',
                'nextPaymentAsString'
            )
        );
    }

    public function create(Company $company)
    {
        $statues = (new Client())->getStatusValues();
        return view('dashboard::clients.create', compact('company', 'statues'));
    }

    public function store(Company $company, ClientRequest $clientRequest)
    {
        toastr()->success(__("Client created"));
        $this->clientService->create($company, $clientRequest->validated());

        return redirect()->route('dashboard.company.clients.index', $company);
    }

    public function edit(Company $company, Client $client)
    {
        $statues = $client->getStatusValues();
        return view('dashboard::clients.edit', compact('company', 'client', 'statues'));
    }

    public function update(Company $company, Client $client, ClientRequest $clientRequest)
    {
        toastr()->success(__("Client has been updated"));
        $this->clientService->update($client, $clientRequest->validated());

        return redirect()->back();
    }

    public function destroy(Company $company, Client $client)
    {
        toastr()->success(__("Client has been deleted"));
        $client->delete();
        return response()->json(['message' => null, 'success' => true], 204);
    }

    public function calculateDaysForNextMonth(Client $client)
    {
        $client->calculateNextLeftDays();
        return response()->json(['message' => null, 'success' => true], 200);
    }
}
