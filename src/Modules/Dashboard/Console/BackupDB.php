<?php

namespace Modules\Dashboard\Console;

use Illuminate\Console\Command;
use Modules\Dashboard\Emails\SendBackDBtoEmail;
use Modules\Dashboard\Services\DumpDBService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class BackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db {--by=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creating backup db by...';

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
     * @param DumpDBService $dumpDBService
     * @return mixed
     */
    public function handle(DumpDBService $dumpDBService): void
    {
        $dumpDBService->makeSnapshot();
        $pathToDump = $dumpDBService->getPathToSnapshot();

        if ($this->option('by') === 'email') {
            $dumpDBService->sendBackupByEmail($pathToDump);
        }
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
