<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Services\ClientService;

class DashboardController extends BaseController
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        $amountAllUsers    = User::count();
        $amountAllClients  = Client::count();

        $amountUserOwnClients = $this->clientService->countOwnClients();

        return view('dashboard::index', compact(
            'amountAllUsers',
        'amountAllClients',
            'amountUserOwnClients'
        ));
    }
}
