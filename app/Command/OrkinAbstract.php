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
use Minicli\Input;
use Minicli\Output\OutputHandler;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Container\ContainerAbstract;
use Viduc\Orkin\Translation\Translation;

abstract class OrkinAbstract extends CommandController
{
    /**
     * @var Container
     */
    public Container $container;

    public Translator $translator;

    /**
     * @var string
     */
    public string $baseDir = '';

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct()
    {
        $this->container = ContainerAbstract::getContainer();
        $this->translator = $this->container->get('translation')->translator;
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

    /**
     * @param string $identifier
     * @param string $display
     *
     * @return bool
     */
    public function getInputYesOrNo(
        string $identifier,
        string $display = ''
    ): bool {
        $this->getPrinter()->display($display);
        $value = null;
        while ($value === null) {
            $input = new Input($identifier.'? (Y/n) > ');
            $value = $input->read();
            $value = $value === '' ? 'y' : $value;
            $value = in_array(strtolower($value), ['y', 'n']) ?
                strtolower($value) === 'y' : null;
        }

        return $value == 'y';
    }
}