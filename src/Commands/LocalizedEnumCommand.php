<?php

namespace Bakr\LocalizedEnum\Commands;

use Illuminate\Console\Command;

class LocalizedEnumCommand extends Command
{
    public $signature = 'localized-enum';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
