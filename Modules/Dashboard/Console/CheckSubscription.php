<?php

namespace Modules\Dashboard\Console;

use App\Models\Client;
use App\Models\CronLog;
use Illuminate\Console\Command;
use Modules\Dashboard\Services\ClientService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:subscription {--check-every-hours=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscription for everyone client.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ClientService $clientService
     * @return mixed
     */
    public function handle(ClientService $clientService)
    {
        if ($hours = $this->option('check-every-hours')) {
            if(!$clientService->isTimePassedSinceLastLaunchCron($hours)){
                return false;
            }
        }

        Client::active()
            ->with('company.currency')
            ->chunk(50, function ($clients) use ($clientService) {
                foreach ($clients as $client){
                    $clientService->checkActiveSubscription($client);
                }
            });

        $clientService->insertCronLogInfoAboutCheckSubscriptionResult();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
