<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Configuration;

use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Models\ConfigurationModel;
use Viduc\Orkin\Services\FolderServiceAbstract;

class Configuration
{
    public ConfigurationModel $configurationModel;

    public function __construct(
        private ConfigurationFactory $factory,
        private Serializer $serializer
    ) {
        $this->configurationModel = $factory->create();
    }

    public function isNewConfiguration(): bool
    {
        return $this->configurationModel->newConfiguration;
    }

    public function getQualityPath(): string
    {
        return $this->configurationModel->qualityPath;
    }

    public function persist(): void
    {
        file_put_contents(
            FolderServiceAbstract::getRootDir().$this->factory->configFile,
            $this->serializer->serialize($this->configurationModel, 'yaml')
        );
    }
}