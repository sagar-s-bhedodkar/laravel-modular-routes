<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Console;

use Illuminate\Console\Command;
use SagarSBhedodkar\LaravelModularRoutes\Services\ModuleCreator;

class MakeModuleCommand extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create a new module with CRUD routes and controller.';

    public function handle(ModuleCreator $creator): int
    {
        $name = ucfirst($this->argument('name'));
        $creator->create($name);
        $this->info("✅ Module '{$name}' created successfully.");
        return 0;
    }
}
