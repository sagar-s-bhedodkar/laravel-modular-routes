<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Class ListModulesCommand
 *
 * Console command to list all available modules in the application.
 *
 * In a modular Laravel application, each module typically resides in its
 * own directory inside the `modules` folder. This command scans the
 * `modules` directory, retrieves all module names, and displays them
 * in a formatted table in the console.
 *
 * Example usage:
 *   php artisan module:list
 *
 * Workflow:
 *   1. Determine the path to the `modules` directory using `base_path`.
 *   2. Check if the directory exists. If not, display a warning and exit.
 *   3. Scan the directory for all subdirectories (representing modules).
 *   4. Extract the base name of each directory to get the module name.
 *   5. Display all module names in a console table for easy readability.
 *
 * Dependencies:
 *   - File facade: Used for directory existence checks and scanning.
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Console
 */
class ListModulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * This is how the command is executed via Artisan.
     *
     * @var string
     */
    protected $signature = 'module:list';

    /**
     * The console command description.
     *
     * Provides a brief explanation of the command, shown when running
     * `php artisan list` or `php artisan help module:list`.
     *
     * @var string
     */
    protected $description = 'List all available modules.';

    /**
     * Handle the execution of the console command.
     *
     * This method performs all the logic for listing modules, including
     * validation, directory scanning, and output formatting.
     *
     * @return void
     *
     * Detailed Steps:
     *   1. Determine the path to the `modules` directory.
     *   2. Verify that the `modules` directory exists.
     *      - If not, output a warning message and terminate.
     *   3. Retrieve all directories inside the `modules` folder.
     *   4. Extract each directory's base name to identify the module names.
     *   5. Use the `table` method to display the list of module names
     *      in a structured, easy-to-read console table.
     */
    public function handle(): void
    {
        // Determine the absolute path to the modules folder
        $path = base_path('modules');

        // Verify if the modules directory exists
        if (!File::isDirectory($path)) {
            // Warn the user if no modules directory is found and exit
            $this->warn('No modules directory found.');
            return;
        }

        // Retrieve all subdirectories in the modules folder
        $modules = collect(File::directories($path))
            // Extract only the folder name, ignoring the full path
            ->map(fn($dir) => basename($dir))
            ->toArray();

        // Display the module names in a formatted table in the console
        $this->table(['Module Name'], collect($modules)->map(fn($m) => [$m]));
    }
}
