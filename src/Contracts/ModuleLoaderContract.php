<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Contracts;

interface ModuleLoaderContract
{
    public function load(): void;
    public function clearCache(): void;
}
