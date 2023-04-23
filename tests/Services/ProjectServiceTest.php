<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests\Services;

use Symfony\Component\Filesystem\Filesystem;
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\FileSystem\IniFile;
use Viduc\Orkin\Services\ProjectService;
use Viduc\Orkin\Tests\OrkinTestCase;

class ProjectServiceTest extends OrkinTestCase
{
    /**
     * @var ProjectService|null
     */
    private ?ProjectService $createService;

    /**
     * @var ConfigurationFactory|null
     */
    private ?ConfigurationFactory $configurationFactory;

    /**
     * @var Configuration|null
     */
    private ?Configuration $configuration;
    /**
     * @var ToolsFactory|null
     */
    private ?ToolsFactory $toolsFactory;
    private ?IniFile $iniFile;

    public function setUp(): void
    {
        parent::setUp();
        $this->configurationFactory = new ConfigurationFactory($this->serializer);
        $this->configurationFactory->configFile = $this->configFile;
        $this->toolsFactory = $this->createMock(ToolsFactory::class);
        $this->iniFile = $this->createMock(IniFile::class);
        $this->configuration = new Configuration(
            $this->configurationFactory,
            $this->serializer,
            $this->toolsFactory,
            $this->iniFile
        );
        $this->configuration->configurationModel->qualityPath = $this->qualityPath;
        $this->configuration->configurationModel->newConfiguration = true;
        $this->configuration->configurationModel->phingFolder = $this->phingFolder;
        $this->configuration->configurationModel->phingFile = $this->phingFile;
        $this->createService = new ProjectService(
            $this->configuration,
            new Filesystem()
        );
    }

    public function testCreate(): void
    {
        $qualityPath = Constantes::getProjectDir().$this->qualityPath;
        $this->createService->project = $qualityPath;
        $this->assertDirectoryDoesNotExist($qualityPath);
        $this->createService->create();
        $this->assertDirectoryExists($qualityPath);
        $this->assertDirectoryExists(
            $qualityPath.DIRECTORY_SEPARATOR.Constantes::FOLDER_PHING
        );
        $this->assertFileExists(
            $qualityPath.DIRECTORY_SEPARATOR.Constantes::FILE_PHING
        );
    }
}