<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests\Configuration;

use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Tests\OrkinTestCase;

class ConfigurationTest extends OrkinTestCase
{
    private Configuration $configuration;
    private ConfigurationFactory $configurationFactory;
    public function setUp(): void
    {
        parent::setUp();
        $this->configurationFactory = new ConfigurationFactory($this->serializer);
        $this->configurationFactory->configFile = $this->configFile;
        $this->configuration = new Configuration(
            $this->configurationFactory,
            $this->serializer
        );
    }

    public function testPersist(): void
    {
        $this->configuration->persist();
        $this->assertFileExists(
            Constantes::getProjectDir().$this->configFile
        );
    }
}