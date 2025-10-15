<?php

namespace Tests\Feature;

use Tests\TestCase;
use SagarSBhedodkar\LaravelModularRoutes\Support\ModuleLoader;

class ModuleLoaderTest extends TestCase
{
    public function test_loader_instantiates()
    {
        $loader = new ModuleLoader();
        $this->assertInstanceOf(ModuleLoader::class, $loader);
    }
}
