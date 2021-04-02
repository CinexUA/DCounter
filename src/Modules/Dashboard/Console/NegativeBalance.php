<?php

namespace Modules\Dashboard\Console;

use Illuminate\Console\Command;
use Modules\Dashboard\Emails\SendBackDBtoEmail;
use Modules\Dashboard\Services\CompanyService;
use Modules\Dashboard\Services\DumpDBService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class NegativeBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:negative-balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notifying users of a negative balance';

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
     * @param CompanyService $companyService
     * @return mixed
     */
    public function handle(CompanyService $companyService): void
    {
        $companyService->notifyingUsersOfNegativeBalance();
        $companyService->insertCronLogNegativeBalanceNotifyResult();
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
