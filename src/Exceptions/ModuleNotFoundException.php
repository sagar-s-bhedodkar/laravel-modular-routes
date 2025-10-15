<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Exceptions;

use Exception;

/**
 * Thrown when a module is missing route files.
 */
class ModuleNotFoundException extends Exception
{
    public function __construct(string $message = "Module routes not found", int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
