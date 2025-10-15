<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Contracts;

/**
 * Interface ModuleLoaderContract
 *
 * This interface defines the contract for module loading and cache management
 * in a modular Laravel application. Any class implementing this contract must
 * provide implementations for loading modules and clearing their cached data.
 *
 * Purpose:
 *   - Enforce a consistent API for module loaders.
 *   - Ensure that modules can be dynamically loaded and cache can be cleared
 *     reliably across the application.
 *
 * Usage:
 *   A service or class implementing this contract should handle the actual
 *   logic of module discovery, initialization, and cache management.
 *
 * Example:
 *   class ModuleLoader implements ModuleLoaderContract
 *   {
 *       public function load(): void { ... }
 *       public function clearCache(): void { ... }
 *   }
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Contracts
 */
interface ModuleLoaderContract
{
    /**
     * Load all modules into the application.
     *
     * This method is responsible for:
     *   - Discovering available modules (typically scanning the `modules` directory)
     *   - Registering module routes, providers, or any other initialization logic
     *   - Ensuring the modules are ready to be used in the application
     *
     * @return void
     */
    public function load(): void;

    /**
     * Clear any cached data related to modules.
     *
     * This method should remove any cached module metadata, routes,
     * or configuration to ensure fresh loading on the next request.
     *
     * @return void
     */
    public function clearCache(): void;
}
