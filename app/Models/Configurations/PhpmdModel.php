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
class PhpmdModel extends ConfigurationModelAbstract
{
    public string $mode;
    public string $reportType;
    public string $reportFile;

    public function __construct(array $config = [])
    {
        $this->isUsed = $config['isUsed'] ?? true;
        $this->mode = $config['mode'] ?? ToolsConstantes::CONFIG_PHPMD['mode'];
        $this->reportType = $config['reportType'] ??
            ToolsConstantes::CONFIG_PHPMD['reportType'];
        $this->reportFile = $config['reportFile'] ??
            ToolsConstantes::CONFIG_PHPMD['reportFile'];
    }
}
