<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Console;

use Illuminate\Console\Command;
use SagarSBhedodkar\LaravelModularRoutes\Support\ModuleLoader;

class ClearModulesCacheCommand extends Command
{
    protected $signature = 'module:clear-cache';
    protected $description = 'Clear cached module data.';

    public function handle(ModuleLoader $loader): void
    {
        $loader->clearCache();
        $this->info('✅ Module cache cleared successfully.');
    }
}
