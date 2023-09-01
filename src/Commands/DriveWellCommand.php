<?php

namespace Bouhaddi\DriveWell\Commands;

use Illuminate\Console\Command;

class DriveWellCommand extends Command
{
    public $signature = 'drivewell';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
