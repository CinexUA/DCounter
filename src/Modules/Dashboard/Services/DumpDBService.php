<?php

namespace Modules\Dashboard\Services;


use App\Models\Client;
use App\Models\Company;
use App\Models\CronLog;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class DumpDBService extends BaseService
{
    public function makeSnapshot(): void
    {
        Artisan::call('snapshot:create db-dump --compress');
    }

    public function getPathToSnapshot(): string
    {
        return database_path('snapshots/db-dump.sql.gz');
    }

    public function sendBackupByEmail(string $pathToDump)
    {
        Mail::raw('Database backup created at: ' . now(),   function ($message) use ($pathToDump) {
            $message->to(env('DB_BACKUP_EMAIL'))
                ->subject(env('APP_NAME') . ' DB Auto-backup: ' . now())
                ->attach($pathToDump);
        });
    }
}
