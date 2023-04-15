<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Configuration;

use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\Models\ConfigurationModel;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Translations\Translation;

class Manual
{
    public $locale = 'en_US';
    private Translator $translator;
    public ConfigurationModel $configurationModel;

    public function __construct(
        public Answers     $answers,
        Translation $translation,
        private ToolsFactory $toolsFactory,
        private ConfigurationFactory $configurationFactory
    ) {
        $this->translator = $translation->translator;
        $this->configurationModel = $this->configurationFactory->create();
    }

    final public function create(): void
    {
        $this->toolsFactory->locale = $this->locale;
        $this->toolsFactory->answers = $this->answers;
        $this->configurationModel->qualityPath = $this->qualityFolderName();
        $this->configurationModel->srcFolder = $this->srcFolderName();
        $this->configurationModel->reportsFolder = $this->reportFolderName();

        foreach (Constantes::LIST_TOOLS as $tool) {
            $this->configurationModel->{$tool.'Model'} = $this->toolsFactory->create(
                ['tool' => $tool]
            )->configure();
        }
    }

    private function qualityFolderName(): string
    {
        return $this->answers->getInputString(
            'Quality Folder Name',
            $this->translator->trans(
                'name quality folder',
                [],
                'messages',
                $this->locale
            ),
            'quality'
        );
    }

    private function srcFolderName(): string
    {
        return $this->answers->getInputString(
            'Source Folder Name',
            $this->translator->trans(
                'name src folder',
                [],
                'messages',
                $this->locale
            ),
            'src'
        );
    }

    private function reportFolderName(): string
    {
        return $this->answers->getInputString(
            'Report Folder Name',
            $this->translator->trans(
                'name report folder',
                [],
                'messages',
                $this->locale
            ),
            'reports'
        );
    }
}