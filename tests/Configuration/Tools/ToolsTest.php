<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests\Configuration\Tools;

use ReflectionClass;
use ReflectionException;
use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Configuration\Tools\KahlanTools;
use Viduc\Orkin\Configuration\Tools\PhpcsfixerTools;
use Viduc\Orkin\Configuration\Tools\PhpcsTools;
use Viduc\Orkin\Configuration\Tools\PhplocTools;
use Viduc\Orkin\Configuration\Tools\PhpmdTools;
use Viduc\Orkin\Configuration\Tools\PhpstanTools;
use Viduc\Orkin\Configuration\Tools\PhpunitTools;
use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Tests\OrkinTestCase;
use Viduc\Orkin\Translations\Translation;
use Viduc\Orkin\Tests\DataProviders\ToolsDataProvider;

class ToolsTest extends OrkinTestCase
{
    private Answers $answers;
    private ConfigurationsFactory $configurationsFactory;
    private Translation $translation;
    private PhpunitTools $phpunit;
    private KahlanTools $kahlan;
    private PhpcsfixerTools $phpcsfixer;
    private PhpcsTools $phpcs;
    private PhpmdTools $phpmd;
    private PhpstanTools $phpstan;
    private PhplocTools $phploc;

    public function setUp(): void
    {
        parent::setUp();
        $this->answers = $this->createMock(Answers::class);
        $this->configurationsFactory = $this->createMock(
            ConfigurationsFactory::class
        );
        $translator = $this->createMock(Translator::class);
        $this->translation = $this->createMock(Translation::class);
        $this->translation->translator = $translator;
    }

    /**
     * @dataProvider \Viduc\Orkin\Tests\DataProviders\ToolsDataProvider::toolsDataProvider()
     * @throws ReflectionException
     */
    public function testSetPropertiesConfiguration(array $provider): void
    {
        foreach (ToolsConstantes::LIST_TOOLS as $tool) {
            $reflectionClass = new ReflectionClass(
                ToolsConstantes::LIST_TOOLS_CLASS[$tool]
            );
            $this->$tool = $reflectionClass->newInstanceArgs(
                [
                    $this->answers,
                    $this->configurationsFactory,
                    $this->translation
                ]
            );
        }
        foreach ($provider as $tool => $value) {
            $properties = $this->$tool->setPropertiesConfiguration(
                [],
                $value['model']
            );
            $this->assertEquals(
                $value['expected'],
                $properties
            );
        }
    }
}