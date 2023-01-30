<?php

namespace Modules\Client\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Client\Transformers\TransactionResource;
use Modules\Dashboard\Services\ClientService;

class ClientController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        return view('client::index');
    }

    public function getPaymentHistory(Request $request, $rememberToken)
    {
        $client = Client::whereRememberToken($rememberToken)->firstOrFail();
        $transactions = $this->clientService->getPaginateTransactions($client, $request->get('per-page'));
        return TransactionResource::collection($transactions);
    }
}
