<?php

namespace Hollyit\Laratus\Commands;

use Illuminate\Console\Command;

class LaratusGarbageCollectorCommand extends Command
{
    protected $signature = 'laratus:garbage-collector';

    protected $description = 'Command description';

    public function handle(): void {}
}
