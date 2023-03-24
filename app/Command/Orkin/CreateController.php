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

use Viduc\Orkin\Command\OrkinAbstract;

class CreateController extends OrkinAbstract
{
    /**
     * @return void
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
     * @return void
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
            $this->projectService->create();
        }
    }
}