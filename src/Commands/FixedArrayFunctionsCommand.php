<?php

namespace Petrobolos\FixedArray\Commands;

use Illuminate\Console\Command;

class FixedArrayFunctionsCommand extends Command
{
    public $signature = 'fixed-array-functions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
