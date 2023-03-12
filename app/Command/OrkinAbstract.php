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

use League\Container\Container;
use Minicli\Command\CommandController;
use Minicli\Output\OutputHandler;
use Viduc\Orkin\Container\ContainerAbstract;

abstract class OrkinAbstract extends CommandController
{
    /**
     * @var Container
     */
    public Container $container;

    /**
     * @var string
     */
    public string $baseDir = '';

    public function __construct()
    {
        $this->container = ContainerAbstract::getContainer();
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