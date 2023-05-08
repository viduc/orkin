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

use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Models\ConfigurationModel;
use Viduc\Orkin\Tests\OrkinTestCase;

class ConfigurationFactoryTest extends OrkinTestCase
{
    private ConfigurationFactory $configurationFactory;
    private ConfigurationsFactory $configurationsFactory;
    public function setUp(): void
    {
        parent::setUp();
        $this->configurationsFactory = new ConfigurationsFactory();
        $this->configurationFactory = new ConfigurationFactory(
            $this->serializer,
            $this->configurationsFactory
        );
        $this->configurationFactory->configFile = $this->configFile;
    }

    public function testCreate(): void
    {
        $this->assertTrue($this->configurationFactory->create()->newConfiguration);
        $model = new ConfigurationModel(['newConfiguration' => false]);
        file_put_contents(
            Constantes::getProjectDir().$this->configFile,
            $this->serializer->serialize($model, 'yaml')
        );
        $this->assertFalse($this->configurationFactory->create()->newConfiguration);
    }
}