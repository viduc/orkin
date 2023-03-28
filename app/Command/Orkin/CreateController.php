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
            if ($this->askUseDefaultConfiguration()) {
                $this->projectService->create();
            } else {
                $this->askQualityFolderName();
            }
        }
        $this->getPrinter()->info(
            'info',
            true
        );
        $this->getPrinter()->newline();
    }

    /**
     * @return bool
     */
    private function askUseDefaultConfiguration(): bool
    {
        return $this->getInputYesOrNo(
            'ConfigurationModel',
            $this->translator->trans(
                'create default configuration',
                [],
                'messages',
                $this->locale
            )
        );
    }

    private function askQualityFolderName(): void
    {
        var_dump($this->getInputString(
            'qualityFolderName',
            $this->translator->trans(
                'name quality folder'
                [],
                'messages',
                $this->locale
            )
        ));
    }
}