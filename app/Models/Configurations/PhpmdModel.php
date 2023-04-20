<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Models\Configurations;

use Viduc\Orkin\Constantes\Constantes;

class PhpmdModel extends ConfigurationModelAbstract
{
    public string $mode = CONSTANTES::CONFIG_PHPMD['mode'];
    public string $reportType = CONSTANTES::CONFIG_PHPMD['reportType'];
    public string $reportFile = CONSTANTES::CONFIG_PHPMD['reportFile'];
}
