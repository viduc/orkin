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

class PhpstanModel extends ConfigurationModelAbstract
{
    public int $level = CONSTANTES::CONFIG_PHPSTAN['level'];
    public bool $xdebug = CONSTANTES::CONFIG_PHPSTAN['xdebug'];
}
