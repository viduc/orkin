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

use Viduc\Orkin\Constantes\ToolsConstantes;

/**
 * @codeCoverageIgnore
 */
class KahlanModel extends ConfigurationModelAbstract
{
    public string $folderSpec = ToolsConstantes::CONFIG_KAHLAN['folderSpec'];
    public string $reporterConsole = ToolsConstantes::CONFIG_KAHLAN['reporterConsole'];
    public string $reporterCoverage = ToolsConstantes::CONFIG_KAHLAN['reporterCoverage'];
    public int $coverageLevel = ToolsConstantes::CONFIG_KAHLAN['coverageLevel'];

    public string $checkreturn = ToolsConstantes::CONFIG_KAHLAN['checkreturn'];
}
