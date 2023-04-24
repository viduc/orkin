<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Configuration;

use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\FileSystem\IniFile;
use Viduc\Orkin\Models\ConfigurationModel;

class Configuration
{
    public ConfigurationModel $configurationModel;
    public string $propertiesFile;

    public function __construct(
        private ConfigurationFactory $factory,
        private Serializer $serializer,
        private ToolsFactory $toolsFactory,
        public IniFile $iniFile
    ) {
        $this->configurationModel = $factory->create();
        $this->propertiesFile = Constantes::getProjectDir()
            .Constantes::FOLDER_PHING.DIRECTORY_SEPARATOR
            .Constantes::BUILD_PROPERTIES;
    }

    /**
     * @return bool
     */
    public function isNewConfiguration(): bool
    {
        return $this->configurationModel->newConfiguration;
    }

    /**
     * @return string
     */
    public function getQualityPath(): string
    {
        return $this->configurationModel->qualityPath;
    }

    /**
     * @return string
     */
    public function getPhingFolder(): string
    {
        return $this->configurationModel->phingFolder;
    }

    /**
     * @return string
     */
    public function getPhingFile(): string
    {
        return $this->configurationModel->phingFile;
    }

    /**
     * @return void
     */
    public function persist(): void
    {
        file_put_contents(
            Constantes::getProjectDir().$this->factory->configFile,
            $this->serializer->serialize($this->configurationModel, 'yaml')
        );
    }

    /**
     * @return void
     */
    public function persistProperties(): void
    {
        $buildProperties = parse_ini_file($this->propertiesFile);
        $buildProperties['quality.folder'] = $this->getQualityPath();
        $buildProperties['src'] = $this->configurationModel->srcFolder;
        $buildProperties['reports.folder'] = $this->configurationModel->reportsFolder;

        foreach (ToolsConstantes::LIST_TOOLS as $tool) {
            $buildProperties = $this->toolsFactory->create(
                ['tool' => $tool]
            )->setPropertiesConfiguration(
                $buildProperties,
                $this->configurationModel->{$tool.'Model'}
            );
        }

        $this->iniFile->writeIniFile($buildProperties, $this->propertiesFile);
    }
}
