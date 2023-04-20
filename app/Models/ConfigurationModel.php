<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Models;

use Viduc\Orkin\Models\Configurations\KahlanModel;
use Viduc\Orkin\Models\Configurations\PhpcsfixerModel;
use Viduc\Orkin\Models\Configurations\PhpcsModel;
use Viduc\Orkin\Models\Configurations\PhplocModel;
use Viduc\Orkin\Models\Configurations\PhpmdModel;
use Viduc\Orkin\Models\Configurations\PhpstanModel;
use Viduc\Orkin\Models\Configurations\PhpunitModel;

class ConfigurationModel implements ModelInterface
{
    public bool $newConfiguration = true;
    public string $qualityPath = '';
    public string $phingFolder = '';
    public string $phingFile = '';
    public string $reportsFolder = '';
    public string $srcFolder = '';
    public ?PhpunitModel $phpunitModel;
    public ?KahlanModel $kahlanModel;
    public ?PhpcsfixerModel $phpcsfixerModel;
    public ?PhpcsModel $phpcsModel;
    public ?PhpmdModel $phpmdModel;
    public ?PhpstanModel $phpstanModel;
    public ?PhplocModel $phplocModel;

    public function __construct(array $config = [])
    {
        $this->newConfiguration = $config['newConfiguration'] ?? true;
        $this->qualityPath = $config['qualityPath'] ?? '';
        $this->phingFolder = $config['phingFolder'] ?? '';
        $this->reportsFolder = $config['reportsFolder'] ?? '';
        $this->srcFolder = $config['src'] ?? '';
        $this->phingFile = $config['phingFile'] ?? '';
        $this->phpunitModel = $config['phpunit'] ?? null;
        $this->kahlanModel = $config['kahlan'] ?? null;
        $this->phpcsfixerModel = $config['phpcsfixer'] ?? null;
        $this->phpcsModel = $config['phpcs'] ?? null;
        $this->phpmdModel = $config['phpmd'] ?? null;
        $this->phpstanModel = $config['phpstan'] ?? null;
        $this->phplocModel = $config['phploc'] ?? null;
    }
}
