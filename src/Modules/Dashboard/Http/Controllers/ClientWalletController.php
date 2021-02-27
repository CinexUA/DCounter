<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Http\Requests\ClientRequest;
use Modules\Dashboard\Http\Requests\ClientWalletRequest;
use Modules\Dashboard\Services\ClientService;

class ClientWalletController extends BaseController
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->authorizeResource(Client::class);
        $this->clientService = $clientService;
    }

    public function edit(Client $client)
    {
        $client->load('company');
        return view('dashboard::client-wallet.edit', compact('client'));
    }

    public function update(Client $client, ClientWalletRequest $request)
    {
        toastr()->success(__("Wallet balance updated"));
        $this->clientService->makeTransaction(
            $client,
            ($request->get('amount') * 100),
            $request->get('description', ''),
            $request->has('is_deposit')
        );

        return redirect()->route('dashboard.company.clients.show', [$client->company->getKey(), $client]);
    }

    public function transactions(Company $company, Client $client, Request $request)
    {
        $this->authorize('view', $company);
        $transactions = $this->clientService->getPaginateTransactions($client, $request->get('per-page'));
        return view('dashboard::client-wallet.transactions', compact('client', 'transactions'));
    }
}
