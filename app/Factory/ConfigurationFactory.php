<?php
/**
 * This file is part of the Api package.
 *
 * (c) GammaSoftware <http://www.winlassie.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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

    public function create(): ConfigurationModel
    {
        $path = Constantes::getRootDir().$this->configFile;
        return File_exists($path) ? $this->serializer->deserialize(
            file_get_contents($path),
            ConfigurationModel::class,
            'yaml'
        ): new ConfigurationModel(Constantes::CONFIG_DEFAULT);
    }
}