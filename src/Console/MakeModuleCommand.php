<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Console;

use Illuminate\Console\Command;
use SagarSBhedodkar\LaravelModularRoutes\Services\ModuleCreator;

/**
 * Class MakeModuleCommand
 *
 * Console command to generate a new module in a Laravel application using the
 * modular routes package. This command handles the creation of the module folder,
 * CRUD controller, and automatically sets up routes for the module.
 *
 * Example usage:
 *   php artisan make:module Blog
 *
 * This will:
 *   1. Create a "Blog" module directory under the `modules` folder.
 *   2. Generate a default controller inside the module.
 *   3. Add basic CRUD routes for the module.
 *
 * Dependencies:
 *   - ModuleCreator: Service that encapsulates the module creation logic.
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Console
 */
class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * {name} - Required argument representing the name of the new module.
     *          The name will be automatically capitalized.
     *
     * Example:
     *   php artisan make:module Product
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * Brief description of the command's functionality.
     *
     * @var string
     */
    protected $description = 'Create a new module with CRUD routes and controller.';

    /**
     * Handle the execution of the console command.
     *
     * This method is invoked when the command is executed via Artisan.
     * It uses the ModuleCreator service to generate the module structure and outputs
     * informative messages to the console.
     *
     * @param ModuleCreator $creator Service responsible for handling all module creation tasks.
     *
     * @return int Returns 0 if the command executed successfully.
     *
     * Workflow:
     *   1. Retrieve the "name" argument from the console input.
     *   2. Capitalize the module name to maintain naming conventions.
     *   3. Invoke the ModuleCreator service to generate the module files and directories.
     *   4. Display a confirmation message in the console.
     */
    public function handle(ModuleCreator $creator): int
    {
        // Retrieve the module name argument provided by the user and capitalize it.
        $name = ucfirst($this->argument('name'));

        // Call the ModuleCreator service to create the module with the specified name.
        $creator->create($name);

        // Output a success message to the console for user feedback.
        $this->info("✅ Module '{$name}' created successfully.");

        // Return 0 to indicate that the command executed without errors.
        return 0;
    }
}
