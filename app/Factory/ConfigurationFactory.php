<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Factory;

use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Models\ConfigurationModel;

class ConfigurationFactory implements FactoryInterface
{
    /**
     * @var string
     */
    public string $configFile = Constantes::CONFIG_FILE;

    public function __construct(public Serializer $serializer)
    {
    }

    final public function create(array $params = []): ConfigurationModel
    {
        $path = Constantes::getProjectDir().$this->configFile;
        return File_exists($path) ? $this->serializer->deserialize(
            file_get_contents($path),
            ConfigurationModel::class,
            'yaml'
        ): new ConfigurationModel(Constantes::CONFIG_DEFAULT);
    }
}