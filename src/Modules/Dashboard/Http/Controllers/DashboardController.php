<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Modules\Dashboard\Services\ClientService;
use Modules\Dashboard\Services\DumpDBService;

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

    public function simulationPassedDay()
    {
        abort_if(!app()->environment('local'), 403);
        Artisan::call('check:subscription');
        return redirect()->back()->with(['success' => 'Success']);
    }

    public function dbDump(DumpDBService $dumpDBService)
    {
        $dumpDBService->makeSnapshot();
        $pathToDump = $dumpDBService->getPathToSnapshot();
        return response()
            ->download($pathToDump, 'db-dump.sql.gz', [
                'Content-Type: application/x-gzip',
            ]);
    }
}
