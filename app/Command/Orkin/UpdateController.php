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

/**
 * @codeCoverageIgnore
 */
class UpdateController extends OrkinAbstract
{
    public Configuration $configuration;
    /**
     * @return void
     */
    public function handle(): void
    {
        parent::handle();
        $this->configuration->configurationModel = $this->configurationFactory->create();
        $this->questions->printer = $this->getPrinter();
        $args = $this->getArgs();
        $this->update(count($args)>3 ? array_slice($args,3):
            ToolsConstantes::LIST_TOOLS);
        $this->configuration->persistProperties();
        $this->configuration->persist();
        $this->getPrinter()->info(
            $this->translator->trans(
                'update completed',
                [],
                'messages',
                $this->locale
            ),
            true
        );
        $this->getPrinter()->newline();
    }

    private function update(array $tools): void
    {
        $this->toolsFactory->answers = $this->questions;
        foreach ($tools as $tool) {
            if (!in_array($tool,ToolsConstantes::LIST_TOOLS)) {
                $this->getPrinter()->error(
                    $this->translator->trans(
                        'update tool not found',
                        ['%tool%' => $tool],
                        'messages',
                        $this->locale
                    ),
                    true
                );
                continue;
            }
            $this->configuration->configurationModel->{$tool . 'Model'} =
                $this->toolsFactory->create(['tool' => $tool])->configure($tool);
        }
    }
}
