<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests\Configuration;

use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Configuration\Manual;
use Viduc\Orkin\Configuration\Tools\PhpunitTools;
use Viduc\Orkin\Configuration\Tools\ToolsAbstract;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\Models\ConfigurationModel;
use Viduc\Orkin\Models\Configurations\ConfigurationModelAbstract;
use Viduc\Orkin\Models\Configurations\PhpunitModel;
use Viduc\Orkin\Models\ModelInterface;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Tests\OrkinTestCase;
use Viduc\Orkin\Translations\Translation;

class ManualTest extends OrkinTestCase
{
    private Answers $answers;
    private Translation $translation;
    private Translator $translator;
    private ToolsFactory $toolsFactory;
    private ConfigurationFactory $configurationFactory;
    private Manual $manual;
    public function setUp(): void
    {
        parent::setUp();
        $this->translator = $this->createMock(Translator::class);
        $this->answers = $this->createMock(Answers::class);
        $this->translation = $this->createMock(Translation::class);
        $this->toolsFactory = $this->createMock(ToolsFactory::class);
        $this->configurationFactory = $this->createMock(ConfigurationFactory::class);
        $this->translation->translator = $this->translator;
        $this->manual = new Manual(
            $this->answers,
            $this->translation,
            $this->toolsFactory,
            $this->configurationFactory
        );
    }

    public function testCreate(): void
    {
        $tool = $this->createMock(PhpunitTools::class);
        $model = null;
        $tool->method('configure')->willReturn($model);
        $this->toolsFactory->method('create')->willReturn($tool);
        $this->manual->create();
        $config = ['phingFolder' => 'phing', 'phingFile' => 'build.xml'];
        $this->assertEquals(
            new ConfigurationModel($config),
            $this->manual->configurationModel
        );
    }
}