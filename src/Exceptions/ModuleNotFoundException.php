<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Exceptions;

use Exception;

/**
 * Class ModuleNotFoundException
 *
 * Custom exception thrown when a module is missing route files or cannot be found.
 * 
 * In a modular Laravel application, each module is expected to have its route files
 * properly defined. If a module's routes are missing or the module cannot be loaded,
 * this exception provides a clear, semantic way to handle the error.
 *
 * Default Behavior:
 *   - Message: "Module routes not found"
 *   - HTTP code: 404 (Not Found)
 *
 * Usage Example:
 *   try {
 *       // Attempt to load a module's routes
 *       $moduleLoader->loadModule('Blog');
 *   } catch (ModuleNotFoundException $e) {
 *       // Handle missing module routes gracefully
 *       report($e);
 *       echo $e->getMessage();
 *   }
 *
 * This exception can be caught in middleware, global exception handlers, or
 * any service handling module loading to provide meaningful feedback.
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Exceptions
 */
class ModuleNotFoundException extends Exception
{
    /**
     * Constructor for ModuleNotFoundException.
     *
     * @param string $message Optional custom error message; defaults to "Module routes not found".
     * @param int $code Optional HTTP code for the exception; defaults to 404.
     *
     * Detailed Steps:
     *   1. Accept a custom message or use the default message.
     *   2. Accept a custom code or use the default 404 code.
     *   3. Call the parent Exception constructor to initialize the exception
     *      with the provided message and code.
     */
    public function __construct(string $message = "Module routes not found", int $code = 404)
    {
        // Initialize the base Exception with message and code
        parent::__construct($message, $code);
    }
}
