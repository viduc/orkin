<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Command\Orkin;

use Viduc\Orkin\Command\OrkinAbstract;
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Constantes\ToolsConstantes;

class CreateController extends OrkinAbstract
{
    public Configuration $configuration;
    /**
     * @return void
     */
    public function handle(): void
    {
        parent::handle();
        $this->questions->printer = $this->getPrinter();
        if ($this->configuration->isNewConfiguration()) {
            !$this->askUseDefaultConfiguration() ?
                $this->createManualConfiguration() :
                $this->createDefaultConfiguration();
            $this->configuration->configurationModel->newConfiguration = false;
            $this->projectService->configuration->configurationModel =
                $this->configuration->configurationModel;
            $this->projectService->create();
            $this->configuration->persistProperties();
        }
        $this->configuration->persist();
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
        return $this->questions->getInputYesOrNo(
            'Default configuration',
            $this->translator->trans(
                'create default configuration',
                [],
                'messages',
                $this->locale
            )
        );
    }

    /**
     * @return void
     */
    private function createDefaultConfiguration(): void
    {
        foreach (ToolsConstantes::LIST_TOOLS as $tool) {
            $this->configuration->configurationModel->{$tool.'Model'} =
                $this->configurationsFactory->create(['model' => $tool]);
        }
    }

    /**
     * @return void
     */
    private function createManualConfiguration(): void
    {
        $this->manual->locale = $this->locale;
        $this->manual->answers = $this->questions;
        $this->manual->create();
        $this->configuration->configurationModel = $this->manual->configurationModel;
    }
}
