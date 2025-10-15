<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Services;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

/**
 * Class ModuleCreator
 *
 * Service responsible for creating module scaffolding in a Laravel modular application.
 *
 * Responsibilities:
 *   - Generate module folder structure under `modules/`.
 *   - Create default CRUD controller and route files for new modules.
 *   - Populate route and controller stubs with proper placeholders.
 *
 * Usage Example:
 *   $creator = new ModuleCreator();
 *   $creator->create('Blog'); // Creates a new "Blog" module with routes and controller
 *
 * This class relies on:
 *   - Filesystem: To manage directories and files.
 *   - Stub files: Templates for API routes, web routes, and controllers located in `stubs/`.
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Services
 */
class ModuleCreator
{
    /**
     * Filesystem instance for managing directories and files.
     *
     * @var Filesystem
     */
    protected Filesystem $files;

    /**
     * Absolute path to the modules directory.
     *
     * @var string
     */
    protected string $modulesPath;

    /**
     * ModuleCreator constructor.
     *
     * Initializes the filesystem instance and sets the base path for modules.
     */
    public function __construct()
    {
        $this->files = new Filesystem();

        // Production-standard: Use a "modules" folder at the project base path
        $this->modulesPath = base_path('modules');
    }

    /**
     * Create a new module with default CRUD routes and controller.
     *
     * Steps:
     *   1. Determine the target path for the new module.
     *   2. Check if the module already exists and throw an exception if it does.
     *   3. Create the directory structure:
     *        - Routes/
     *        - Http/Controllers/
     *   4. Generate route files (API and web) from stubs.
     *   5. Generate the default controller from stub.
     *
     * @param string $name Module name (PascalCase recommended for class naming)
     *
     * @throws RuntimeException if a module with the same name already exists.
     */
    public function create(string $name): void
    {
        $path = "{$this->modulesPath}/{$name}";

        // Check for existing module to prevent overwriting
        if ($this->files->exists($path)) {
            throw new RuntimeException("Module '{$name}' already exists!");
        }

        // Create folder structure for Routes and Controllers with proper permissions
        $this->files->makeDirectory("{$path}/Routes", 0755, true);
        $this->files->makeDirectory("{$path}/Http/Controllers", 0755, true);

        // Generate API route file using stub
        $this->files->put("{$path}/Routes/api.php", $this->getStub('api', $name));

        // Generate optional web route file using stub
        $this->files->put("{$path}/Routes/web.php", $this->getStub('web', $name));

        // Generate default CRUD controller using stub
        $this->files->put("{$path}/Http/Controllers/{$name}Controller.php", $this->getStub('controller', $name));
    }

    /**
     * Retrieve stub content and replace placeholders with module-specific values.
     *
     * Placeholders supported:
     *   - {{ name }}: Replaced with the module name (PascalCase)
     *   - {{ name | strtolower }}: Replaced with lowercase module name
     *
     * @param string $type Stub type ('api', 'web', 'controller')
     * @param string $name Module name
     *
     * @return string Fully populated stub content ready to be written to file.
     *
     * @throws RuntimeException if the stub file does not exist.
     */
    protected function getStub(string $type, string $name): string
    {
        // Determine absolute path to the stub file
        $stubPath = __DIR__ . "/../../stubs/{$type}.stub";

        if (!file_exists($stubPath)) {
            throw new RuntimeException("Stub file for '{$type}' not found at {$stubPath}");
        }

        // Read stub file contents
        $content = file_get_contents($stubPath);

        // Replace placeholders with actual module name values
        $content = str_replace('{{ name }}', $name, $content);
        $content = str_replace('{{ name | strtolower }}', strtolower($name), $content);

        return $content;
    }
}
