<?php

namespace Bouhaddi\DriveWell\Commands;

use Illuminate\Console\Command;
use Bouhaddi\DriveWell\DriveWell;

class DriveWellCommand extends Command
{
    public $signature = 'domain {cmd} {--model=} {--controller=} {--repository=} {--service=} {--route=}';

    public $description = 'Generate a Domain Driven Design Skeleton';

    public function handle()
    {
        $bootstrap = new DriveWell();
        $domainName = $this->argument('cmd');

        $bootstrap->generateDomainSkeleton($domainName, $this->options());

        $this->info("DDD Skeleton for $domainName generated successfully");
    }


}
