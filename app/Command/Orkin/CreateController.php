<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Command\Orkin;

use Minicli\Output\OutputHandler;
use Viduc\Orkin\Command\OrkinAbstract;

class CreateController extends OrkinAbstract
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