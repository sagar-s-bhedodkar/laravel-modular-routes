<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ListModulesCommand extends Command
{
    protected $signature = 'module:list';
    protected $description = 'List all available modules.';

    public function handle(): void
    {
        $path = base_path('modules');
        if (!File::isDirectory($path)) {
            $this->warn('No modules directory found.');
            return;
        }

        $modules = collect(File::directories($path))
            ->map(fn($dir) => basename($dir))
            ->toArray();

        $this->table(['Module Name'], collect($modules)->map(fn($m) => [$m]));
    }
}
