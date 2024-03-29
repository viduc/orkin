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
class PhpcsModel extends ConfigurationModelAbstract
{
    public bool $phpcb;

    public function __construct(array $config = [])
    {
        $this->isUsed = $config['isUsed'] ?? true;
        $this->phpcb = $config['phpcb'] ?? ToolsConstantes::CONFIG_PHPCS['phpcb'];
    }
}
