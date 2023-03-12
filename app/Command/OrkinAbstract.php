<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Command;

use Minicli\Command\CommandController;
use Minicli\Output\OutputHandler;

abstract class OrkinAbstract  extends CommandController
{
    /**
     * @var string
     */
    public string $baseDir = '';

    public function __construct()
    {
        $this->baseDir = str_replace(
            'vendor/viduc/orkin/app/Command',
            '',
            __dir__
        );
    }
    /**
     * @return OutputHandler
     */
    public function getPrinter(): OutputHandler
    {
        return parent::getPrinter();
    }
}