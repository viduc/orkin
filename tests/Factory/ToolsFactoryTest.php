<?php
declare(strict_types=1);
/**
 * This file is part of the orkin Application.
 *
 * (c) GammaSoftware <http://www.winlassie.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Viduc\Orkin\Tests\Factory;

use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Tests\OrkinTestCase;
use Viduc\Orkin\Translations\Translation;

class ToolsFactoryTest extends OrkinTestCase
{
    private ToolsFactory $factory;
    private Answers $answers;
    private ConfigurationsFactory $configurationsFactory;
    private Translation $translation;
    private Translator $translator;

    public function setUp(): void
    {
        parent::setUp();
        $this->answers = $this->createMock(Answers::class);
        $this->configurationsFactory = $this->createMock(
            ConfigurationsFactory::class
        );
        $this->translation = $this->createMock(Translation::class);
        $this->translation->translator = $this->createMock(
            Translator::class
        );
        $this->factory = new ToolsFactory(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
    }

    public function testCreate(): void
    {
        foreach (ToolsConstantes::LIST_TOOLS_CLASS as $tool => $toolClass) {
            $this->assertInstanceOf(
                ToolsConstantes::LIST_TOOLS_CLASS[$tool],
                $this->factory->create(['tool' => $tool])
            );
        }
    }
}