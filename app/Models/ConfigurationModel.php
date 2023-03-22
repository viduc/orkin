<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Models;

class ConfigurationModel implements ModelInterface
{
    public bool $newConfiguration = true;
    public string $qualityPath = '';
    public string $phingFolder = '';
    public string $phingFile = '';

    public function __construct(array $config = [])
    {
        $this->newConfiguration = $config['newConfiguration'] ?? true;
        $this->qualityPath = $config['qualityPath'] ?? '';
        $this->phingFolder = $config['phingFolder'] ?? '';
        $this->phingFile = $config['phingFile'] ?? '';
    }
}