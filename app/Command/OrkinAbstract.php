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
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Container\ContainerAbstract;
use Viduc\Orkin\Services\ProjectService;
use Viduc\Orkin\Translations\Translation;

abstract class OrkinAbstract extends CommandController
{
    /**
     * @var Container
     */
    public Container $container;

    /**
     * @var Translation $translation
     */
    private Translation $translation;

    /**
     * @var Translator
     */
    public Translator $translator;

    /**
     * @var string
     */
    public string $locale = 'en_US';

    /**
     * @var Configuration
     */
    public Configuration $configuration;

    public ProjectService $projectService;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct()
    {
        $this->container = ContainerAbstract::getContainer();
        $this->translation = $this->container->get('translation');
        $this->translator = $this->translation->translator;
        $this->configuration = $this->container->get('configuration');
        $this->projectService = $this->container->get('projectService');
    }

    /**
     * @return OutputHandler
     */
    public function getPrinter(): OutputHandler
    {
        return parent::getPrinter();
    }

    /**
     * @return void
     */
    public function defineLocale(): void
    {
        $this->locale = $this->hasParam('locale') ?
            $this->translation->defineLocale(
                $this->getParam('locale')
            ) : 'en_US';
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

    /**
     * @param string $identifier
     * @param string $display
     *
     * @return string
     */
    public function getInputString(
        string $identifier,
        string $display = ''
    ): string {
        if ('' !== $display) {
            $this->getPrinter()->display($display);
        }
        $value = '';
        while ('' === $value) {
            $input = new Input($identifier.' > ');
            $value = $input->read();
        }

        return $value;
    }
}