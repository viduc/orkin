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
use Viduc\Orkin\Exceptions\FolderException;
use Viduc\Orkin\Exceptions\NameException;
use Viduc\Orkin\Services\FolderServiceAbstract;

class CreateController extends OrkinAbstract
{
    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws FolderException
     * @throws NameException
     * @throws NotFoundExceptionInterface
     */
    public function handle(): void
    {
        $this->defineLocale();
        if ($this->configuration->isNewConfiguration()) {
            $this->askUseDefaultConfiguration();
        }
        $this->getPrinter()->info(
            'info',
            true
        );
        $this->getPrinter()->newline();
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws NameException
     * @throws ContainerExceptionInterface
     * @throws FolderException
     */
    private function askUseDefaultConfiguration(): void
    {
        if ($this->getInputYesOrNo(
            'ConfigurationModel',
            $this->translator->trans(
                'create default configuration',
                [],
                'messages',
                $this->locale
            )
        )) {
            FolderServiceAbstract::create(
                $this->configuration->getQualityPath()
            );
        }
    }
}