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
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Models\ModelInterface;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Translations\Translation;

abstract class ToolsAbstract implements ModelInterface
{
    private Translator $translator;

    public ModelInterface $toolModel;

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
     * @return ModelInterface
     */
    public function configure(string $tool): ModelInterface
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
        switch ($tool) {
            case 'kahlan':
                return Constantes::CONFIGURE_KAHLAN_TOOL;
        }

        return [];
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
        switch ($config['type']) {
            case Constantes::TYPE_USE_TOOL:
                $this->toolModel->$attribute = $this->useTool(
                    $tool.$config['identifier'],
                    $tool.$config['translate'],
                );
                break;
            case Constantes::TYPE_USE_TOOL_STRING:
                $this->toolModel->$attribute = $this->useTool(
                    $tool.$config['identifier'],
                    $tool.$config['translate'],
                ) ? 'true' : 'false';
                break;
            case Constantes::TYPE_ANSWER:
                $this->toolModel->$attribute = $this->answer(
                    $tool.$config['identifier'],
                    $tool.$config['translate'],
                    $this->toolModel->$attribute,
                );
                break;
            case Constantes::TYPE_ANSWER_INTEGER:
                $this->toolModel->$attribute = $this->answerInteger(
                    $tool.$config['identifier'],
                    $tool.$config['translate'],
                    $this->toolModel->$attribute,
                );
        }
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
