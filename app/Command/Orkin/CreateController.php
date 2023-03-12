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
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Viduc\Orkin\Command\OrkinAbstract;

class CreateController extends OrkinAbstract
{
    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): void
    {
        if (!$this->container->get('configuration')->isConfigurationAlreadyExist()) {
            $this->askUseDefaultConfiguration();
        }
        $this->getPrinter()->info(
            'info',
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

    private function askUseDefaultConfiguration(): void
    {
        if ($this->getInputYesOrNo(
            'Configuration',
            $this->translator->trans('create default configuration', [], 'messages', 'en_US')
        )) {

        }
    }
}