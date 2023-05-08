<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Factory;

use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Models\ConfigurationModel;

class ConfigurationFactory implements FactoryInterface
{
    public string $configFile = Constantes::CONFIG_FILE;

    public function __construct(
        public Serializer $serializer,
        public ConfigurationsFactory $factory
    ) {
    }

    /**
     * @param  array $params
     * @return ConfigurationModel
     */
    final public function create(array $params = []): ConfigurationModel
    {
        $path = Constantes::getProjectDir().$this->configFile;
        $configuration = new ConfigurationModel(Constantes::CONFIG_DEFAULT);
        if (file_exists($path)) {
            $configuration = $this->serializer->deserialize(
                file_get_contents($path),
                ConfigurationModel::class,
                'yaml'
            );
            $configuration = $this->deserializeModels($configuration);
        }

        return $configuration;
    }

    private function deserializeModels(
        ConfigurationModel $configuration
    ): ConfigurationModel {
        foreach (ToolsConstantes::LIST_TOOLS as $model) {
            $modelName = $model.'Model';
            $configuration->$modelName = $this->factory->create(
                ['model' => $model, 'config' => $configuration->$modelName]
            );
        }

        return $configuration;
    }
}
