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

use Viduc\Orkin\Models\Configurations\KahlanModel;
use Viduc\Orkin\Models\Configurations\PhpunitModel;
use Viduc\Orkin\Models\Configurations\PhpcsfixerModel;
use Viduc\Orkin\Models\Configurations\PhpcsModel;
use Viduc\Orkin\Models\Configurations\PhpmdModel;
use Viduc\Orkin\Models\Configurations\PhpstanModel;
use Viduc\Orkin\Models\Configurations\PhplocModel;
use Viduc\Orkin\Models\ModelInterface;

class ConfigurationsFactory implements FactoryInterface
{
    /**
     * @param array $params
     * @return ModelInterface
     */
    function create(array $params = []): ModelInterface
    {
        switch ($params['model']) {
            case 'kahlan':
                return new KahlanModel();
            case 'phpcsfixer':
                return new PhpcsfixerModel();
            case 'phpcs':
                return new PhpcsModel();
            case 'phpmd':
                return new PhpmdModel();
            case 'phpstan':
                return new PhpstanModel();
            case 'phploc':
                return new PhplocModel();
            default:
                return new PhpunitModel();
        }
    }
}