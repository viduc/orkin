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
    public string $folderSpec;
    public string $reporterConsole;
    public string $reporterCoverage;
    public int $coverageLevel;

    public string $checkreturn;

    public function __construct(array $config = [])
    {
        $this->isUsed = $config['isUsed'] ?? true;
        $this->folderSpec = $config['folderSpec'] ??
            ToolsConstantes::CONFIG_KAHLAN['folderSpec'];
        $this->reporterConsole = $config['reporterConsole'] ??
            ToolsConstantes::CONFIG_KAHLAN['reporterConsole'];
        $this->reporterCoverage = $config['reporterCoverage'] ??
            ToolsConstantes::CONFIG_KAHLAN['reporterCoverage'];
        $this->coverageLevel = $config['coverageLevel'] ??
            ToolsConstantes::CONFIG_KAHLAN['coverageLevel'];
        $this->checkreturn = $config['checkreturn'] ??
            ToolsConstantes::CONFIG_KAHLAN['checkreturn'];
    }
}
