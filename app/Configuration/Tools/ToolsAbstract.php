<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */
namespace Viduc\Orkin\Configuration\Tools;

use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Models\ModelInterface;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Translations\Translation;

abstract class ToolsAbstract implements ModelInterface
{
    private Translator $translator;
    public function __construct(
        public Answers $answers,
        public ConfigurationsFactory $configurationsFactory,
        Translation $translation,
        public string $locale = 'en_US',
    ) {
        $this->translator = $translation->translator;
    }
    abstract public function configure(): ModelInterface;

    final public function useTool(string $indentifier, string $translateId): bool {
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
        }
        while(!is_numeric($response));

        return (int)$response;
    }
}