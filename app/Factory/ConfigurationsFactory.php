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

use Exception;
use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Models\Configurations\ConfigurationModelAbstract;

class ConfigurationsFactory implements FactoryInterface
{
    /**
     * @param array $params
     * @return ConfigurationModelAbstract
     * @throws Exception
     */
    public function create(array $params = []): ConfigurationModelAbstract
    {
        if (empty($params['model']) || !array_key_exists(
            $params['model'],
            ToolsConstantes::LIST_TOOLS_MODEL)
        ) {
            throw new Exception('Model not found');
        }

        return new ToolsConstantes::LIST_TOOLS_MODEL[$params['model']]();
    }
}
