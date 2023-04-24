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
use Viduc\Orkin\Configuration\Tools\PhpunitTools;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\FileSystem\IniFile;
use Viduc\Orkin\Models\Configurations\KahlanModel;
use Viduc\Orkin\Models\Configurations\PhpcsfixerModel;
use Viduc\Orkin\Models\Configurations\PhpcsModel;
use Viduc\Orkin\Models\Configurations\PhplocModel;
use Viduc\Orkin\Models\Configurations\PhpmdModel;
use Viduc\Orkin\Models\Configurations\PhpstanModel;
use Viduc\Orkin\Models\Configurations\PhpunitModel;
use Viduc\Orkin\Tests\OrkinTestCase;

/**
 * @covers Configuration
 */
class ConfigurationTest extends OrkinTestCase
{
    private Configuration $configuration;
    private ConfigurationFactory $configurationFactory;
    private ToolsFactory $toolsFactory;
    private IniFile $iniFile;
    private PhpunitTools $phpunitTools;
    private array $buildProperties;
    public function setUp(): void
    {
        parent::setUp();
        $this->configurationFactory = new ConfigurationFactory($this->serializer);
        $this->configurationFactory->configFile = $this->configFile;

        $this->phpunitTools = $this->createMock(PhpunitTools::class);
        $this->toolsFactory = $this->createMock(ToolsFactory::class);
        $this->buildProperties['quality.folder'] = 'test';
        $this->buildProperties['src'] = 'test';
        $this->buildProperties['reports.folder'] = 'test';
        $this->phpunitTools->method(
            'setPropertiesConfiguration'
        )->willReturn($this->buildProperties);
        $this->toolsFactory->method(
            'create'
        )->willReturn($this->phpunitTools);
        $this->iniFile = new IniFile();
        $this->configuration = new Configuration(
            $this->configurationFactory,
            $this->serializer,
            $this->toolsFactory,
            $this->iniFile
        );
        $this->configuration->configurationModel->phpunitModel =
            $this->createMock(PhpunitModel::class);
        $this->configuration->configurationModel->kahlanModel =
            $this->createMock(KahlanModel::class);
        $this->configuration->configurationModel->phpcsfixerModel =
            $this->createMock(PhpcsfixerModel::class);
        $this->configuration->configurationModel->phpcsModel =
            $this->createMock(PhpcsModel::class);
        $this->configuration->configurationModel->phpmdModel =
            $this->createMock(PhpmdModel::class);
        $this->configuration->configurationModel->phpstanModel =
            $this->createMock(PhpstanModel::class);
        $this->configuration->configurationModel->phplocModel =
            $this->createMock(PhplocModel::class);
        $this->configuration->propertiesFile = str_replace(
            'phing',
            'tests'.DIRECTORY_SEPARATOR.'phing',
            $this->configuration->propertiesFile
        );
    }

    public function testPersist(): void
    {
        $this->configuration->persist();
        $this->assertFileExists(
            Constantes::getProjectDir().$this->configFile
        );
    }

    public function testIsNewConfiguration(): void
    {
        $this->assertTrue($this->configuration->isNewConfiguration());
    }

    public function testGetQualityPath(): void
    {
        $this->assertEquals(
            Constantes::FOLDER_QUALITY,
            $this->configuration->getQualityPath()
        );
    }

    public function testPersistProperties(): void
    {
        $this->configuration->persistProperties();
        $this->assertEquals(
            $this->buildProperties,
            parse_ini_file($this->configuration->propertiesFile)
        );
    }
}