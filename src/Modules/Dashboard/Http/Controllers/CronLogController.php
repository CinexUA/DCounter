<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\CronLog;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Http\Requests\ClientRequest;
use Modules\Dashboard\Http\Requests\ClientWalletRequest;
use Modules\Dashboard\Services\ClientService;

class CronLogController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(CronLog::class);
    }

    public function index()
    {
        $cronLogs = CronLog::latest()->paginate();
        return view('dashboard::cron-logs.index', compact('cronLogs'));
    }
}
