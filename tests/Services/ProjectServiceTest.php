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
use Viduc\Orkin\Services\FolderServiceAbstract;
use Viduc\Orkin\Services\ProjectService;
use Viduc\Orkin\Tests\OrkinTestCase;

class ProjectServiceTest extends OrkinTestCase
{
    /**
     * @var ProjectService
     */
    private ProjectService $createService;

    /**
     * @var ConfigurationFactory
     */
    private ConfigurationFactory $configurationFactory;

    /**
     * @var Configuration
     */
    private Configuration $configuration;

    public function setUp(): void
    {
        parent::setUp();
        $this->configurationFactory = new ConfigurationFactory($this->serializer);
        $this->configurationFactory->configFile = $this->configFile;
        $this->configuration = new Configuration(
            $this->configurationFactory,
            $this->serializer
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

    public function testCreate()
    {
        $qualityPath = Constantes::getRootDir().$this->qualityPath;
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