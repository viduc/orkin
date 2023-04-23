<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Configuration\Tools;

use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Models\Configurations\ConfigurationModelAbstract;
use Viduc\Orkin\Models\ModelInterface;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Translations\Translation;

abstract class ToolsAbstract implements ModelInterface
{
    private Translator $translator;
    public ConfigurationModelAbstract $toolModel;

    public function __construct(
        public Answers $answers,
        public ConfigurationsFactory $configurationsFactory,
        Translation $translation,
        public string $locale = 'en_US',
    ) {
        $this->translator = $translation->translator;
    }

    /**
     * @param string $tool
     * @return ConfigurationModelAbstract
     */
    public function configure(string $tool): ConfigurationModelAbstract
    {
        $this->toolModel = $this->configurationsFactory->create(['model' => $tool]);

        foreach ($this->getConfigTool($tool) as $attribute => $config) {
            $this->getAttributeConfig($tool, $attribute, $config );
        }

        return $this->toolModel;
    }

    /**
     * @param string $tool
     * @return array
     */
    private function getConfigTool(string $tool): array
    {
        return match ($tool) {
            'kahlan' => ToolsConstantes::CONFIGURE_KAHLAN_TOOL,
            'phpcsfixer' => ToolsConstantes::CONFIGURE_PHPCSFIXER_TOOL,
            'phpcs' => ToolsConstantes::CONFIGURE_PHPCS_TOOL,
            'phploc' => ToolsConstantes::CONFIGURE_PHPLOC_TOOL,
            'phpmd' => ToolsConstantes::CONFIGURE_PHPMD_TOOL,
            'phpstan' => ToolsConstantes::CONFIGURE_PHPSTAN_TOOL,
            'phpunit' => ToolsConstantes::CONFIGURE_PHPUNIT_TOOL,
            default => [],
        };
    }

    /**
     * @param string $tool
     * @param string $attribute
     * @param array $config
     * @return void
     */
    private function getAttributeConfig(
        string $tool,
        string $attribute,
        array $config
    ): void {
        $this->toolModel->$attribute = match ($config['type']) {
            ToolsConstantes::TYPE_USE_TOOL =>
                $this->toolModel->isUsed && $this->useTool(
                    $tool . ' ' . $config['identifier'],
                    $tool . ' ' . $config['translate'],
                ),
            ToolsConstantes::TYPE_USE_TOOL_STRING =>
                $this->toolModel->isUsed ? $this->useTool(
                    $tool.' '.$config['identifier'],
                    $tool.' '.$config['translate'],
                ) ? 'true' : 'false': 'false',
            ToolsConstantes::TYPE_ANSWER =>
                $this->toolModel->isUsed ? $this->answer(
                    $tool.' '.$config['identifier'],
                    $tool.' '.$config['translate'],
                    $this->toolModel->$attribute,
                ): $this->toolModel->$attribute,
            ToolsConstantes::TYPE_ANSWER_INTEGER =>
                $this->toolModel->isUsed ? $this->answerInteger(
                    $tool.' '.$config['identifier'],
                    $tool.' '.$config['translate'],
                    $this->toolModel->$attribute,
                ): $this->toolModel->$attribute,
        };
    }

    /**
     * @param string $indentifier
     * @param string $translateId
     * @return bool
     */
    final public function useTool(string $indentifier, string $translateId): bool
    {
        return $this->answers->getInputYesOrNo(
            $indentifier,
            $this->translator->trans(
                $translateId,
                [],
                'messages',
                $this->locale
            )
        );
    }

    /**
     * @param string $indentifier
     * @param string $translateId
     * @param string $default
     * @return string
     */
    final public function answer(
        string $indentifier,
        string $translateId,
        string $default
    ): string {
        return $this->answers->getInputString(
            $indentifier,
            $this->translator->trans(
                $translateId,
                [],
                'messages',
                $this->locale
            ),
            $default
        );
    }

    /**
     * @param string $indentifier
     * @param string $translateId
     * @param int $default
     * @return int
     */
    final public function answerInteger(
        string $indentifier,
        string $translateId,
        int $default
    ): int {
        do {
            $response = $this->answer(
                $indentifier,
                $translateId,
                (string) $default
            );
        } while (!is_numeric($response));

        return (int) $response;
    }
}
