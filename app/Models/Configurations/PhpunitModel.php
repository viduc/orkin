<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Models\Configurations;

use Viduc\Orkin\Constantes\Constantes;

class PhpunitModel extends ConfigurationModelAbstract
{
    public string $folderTest = Constantes::CONFIG_PHPUNIT['folderTest'];
}