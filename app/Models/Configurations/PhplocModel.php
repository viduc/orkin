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

/**
 * @codeCoverageIgnore
 */
class PhplocModel extends ConfigurationModelAbstract
{
    public function __construct(array $config = [])
    {
        $this->isUsed = $config['isUsed'] ?? true;
    }
}
