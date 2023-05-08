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

use Viduc\Orkin\Models\Configurations\ConfigurationModelAbstract;
use Viduc\Orkin\Models\Configurations\KahlanModel;
use Viduc\Orkin\Models\Configurations\PhpcsfixerModel;
use Viduc\Orkin\Models\Configurations\PhpcsModel;
use Viduc\Orkin\Models\Configurations\PhplocModel;
use Viduc\Orkin\Models\Configurations\PhpmdModel;
use Viduc\Orkin\Models\Configurations\PhpstanModel;
use Viduc\Orkin\Models\Configurations\PhpunitModel;

class ConfigurationsFactory implements FactoryInterface
{
    /**
     * @param  array $params
     * @return ConfigurationModelAbstract
     */
    public function create(array $params = []): ConfigurationModelAbstract
    {
        $config = isset($params['config']) ? $params['config'] : [];
        return match ($params['model']) {
            'kahlan' => new KahlanModel($config),
            'phpcsfixer' => new PhpcsfixerModel($config),
            'phpcs' => new PhpcsModel($config),
            'phpmd' => new PhpmdModel($config),
            'phpstan' => new PhpstanModel($config),
            'phploc' => new PhplocModel($config),
            'phpunit' => new PhpunitModel($config)
        };
    }
}
