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

class KahlanModel extends ConfigurationModelAbstract
{
    public string $folderSpec = CONSTANTES::CONFIG_KAHLAN['folderSpec'];
    public string $reporterConsole = CONSTANTES::CONFIG_KAHLAN['reporterConsole'];
    public string $reporterCoverage = CONSTANTES::CONFIG_KAHLAN['reporterCoverage'];
    public int $coverageLevel = CONSTANTES::CONFIG_KAHLAN['coverageLevel'];

    public string $checkreturn = Constantes::CONFIG_KAHLAN['checkreturn'];
}
