<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin;

use Minicli\Command\CommandController;
use Minicli\Output\OutputHandler;

class Orkin extends CommandController
{
    public function handle(): void
    {
        $this->getPrinter()->info(
            'Configure quality tools for your php project',
            true
        );
        $this->getPrinter()->newline();
    }

    /**
     * @return OutputHandler
     */
    public function getPrinter(): OutputHandler
    {
        return parent::getPrinter();
    }
}