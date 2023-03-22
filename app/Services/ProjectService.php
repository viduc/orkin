<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Services;

use Viduc\Orkin\Configuration\Configuration;

class ProjectService implements ServiceInterface
{
    public function __construct(public Configuration $configuration)
    {
    }

    public function create(): void
    {
        FolderServiceAbstract::create(
            $this->configuration->getQualityPath()
        );
    }
}