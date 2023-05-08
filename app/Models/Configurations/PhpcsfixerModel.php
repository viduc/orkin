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
class PhpcsfixerModel extends ConfigurationModelAbstract
{
    public bool $dryRun;
    public string $checkreturn;

    public function __construct(array $config = [])
    {
        $this->isUsed = $config['isUsed'] ?? true;
        $this->dryRun = $config['dryRun'] ??
            ToolsConstantes::CONFIG_PHPCSFIXER['dryrun'];
        $this->checkreturn = $config['checkreturn'] ??
            ToolsConstantes::CONFIG_PHPCSFIXER['checkreturn'];
    }
}
