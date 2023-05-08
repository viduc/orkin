<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Command\Orkin;

use Viduc\Orkin\Command\OrkinAbstract;
use Viduc\Orkin\Configuration\Configuration;

class ExecuteController extends OrkinAbstract
{
    public Configuration $configuration;
    /**
     * @return void
     */
    public function handle(): void
    {
        parent::handle();
        var_dump($this->configuration->getQualityPath());
    }

}
