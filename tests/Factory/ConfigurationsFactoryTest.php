<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests\Factory;

use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Tests\OrkinTestCase;

class ConfigurationsFactoryTest extends OrkinTestCase
{
    private ConfigurationsFactory $factory;
    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new ConfigurationsFactory();
    }

    public function testCreate(): void
    {
        foreach (ToolsConstantes::LIST_MODELS_CLASS as $model => $class) {
            $this->assertInstanceOf(
                $class,
                $this->factory->create(['model' => $model])
            );
        }
    }
}