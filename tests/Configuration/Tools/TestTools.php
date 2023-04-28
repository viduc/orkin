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

namespace Viduc\Orkin\Tests\Configuration\Tools;

use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Configuration\Tools\KahlanTools;
use Viduc\Orkin\Configuration\Tools\PhpcsfixerTools;
use Viduc\Orkin\Configuration\Tools\PhpcsTools;
use Viduc\Orkin\Configuration\Tools\PhplocTools;
use Viduc\Orkin\Configuration\Tools\PhpmdTools;
use Viduc\Orkin\Configuration\Tools\PhpstanTools;
use Viduc\Orkin\Configuration\Tools\PhpunitTools;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Tests\OrkinTestCase;
use Viduc\Orkin\Translations\Translation;

class TestTools extends OrkinTestCase
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

        $this->phpunitTools = new PhpunitTools(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
        $this->kahlanTools = new KahlanTools(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
        $this->phpcsfixerTools = new PhpcsfixerTools(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
        $this->phpcsTools = new PhpcsTools(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
        $this->phpmdTools = new PhpmdTools(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
        $this->phpstanTools = new PhpstanTools(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
        $this->phplocTools = new PhplocTools(
            $this->answers,
            $this->configurationsFactory,
            $this->translation
        );
    }

    public function testSetPropertiesConfiguration(): void
    {
        $this->kahlanTools->isUsed = true;
        $this->kahlanTools->checkreturn = true;
        $this->kahlanTools->folderSpec = 'spec';
        $this->kahlanTools->reporterConsole = 'console';
        $this->kahlanTools->reporterCoverage = 'coverage';
        $this->kahlanTools->coverageLevel = 'level';
        $properties = $this->kahlanTools->setPropertiesConfiguration(
            [],
            $this->kahlanTools
        );
        $this->assertEquals(
            [
                'kahlan.enable' => true,
                'kahlan.checkreturn' => true,
                'kahlan.spec' => 'spec',
                'kahlan.reporter.console' => 'console',
                'kahlan.reporter.coverage' => 'coverage',
                'kahlan.reporter.coverage.level' => 'level',
            ],
            $properties
        );

        $this->phpunitTools->isUsed = true;
        $this->phpunitTools->checkreturn = true;
        $this->phpunitTools->folderTest = 'test';
        $properties = $this->phpunitTools->setPropertiesConfiguration(
            [],
            $this->phpunitTools
        );
        $this->assertEquals(
            [
                'phpunit.enable' => true,
                'phpunit.checkreturn' => true,
                'phpunit.folderTest' => 'test'
            ],
            $properties
        );

        $this->phpcsfixerTools->isUsed = true;
        $this->phpcsfixerTools->checkreturn = true;
        $this->phpcsfixerTools->dryRun = true;
        $properties = $this->phpcsfixerTools->setPropertiesConfiguration(
            [],
            $this->phpcsfixerTools
        );
        $this->assertEquals(
            [
                'phpcsfixer.enable' => true,
                'phpcsfixer.checkreturn' => true,
                'phpcsfixer.dryrun' => true
            ],
            $properties
        );

        $this->phpcsTools->isUsed = true;
        $this->phpcsTools->phpcb = true;
        $properties = $this->phpcsTools->setPropertiesConfiguration(
            [],
            $this->phpcsTools
        );
        $this->assertEquals(
            [
                'phpcs.enable' => true,
                'phpcs.phpcb' => true
            ],
            $properties
        );

        $this->phpmdTools->isUsed = true;
        $this->phpmdTools->mode = 'test';
        $this->phpmdTools->reportType = 'test';
        $this->phpmdTools->reportFile = 'test';
        $properties = $this->phpmdTools->setPropertiesConfiguration(
            [],
            $this->phpmdTools
        );
        $this->assertEquals(
            [
                'phpmd.enable' => true,
                'phpmd.mode' => true,
                'phpmd.reportType' => 'test',
                'phpmd.reportFile' => 'test'
            ],
            $properties
        );

        $this->phpstanTools->isUsed = true;
        $this->phpstanTools->level = 'test';
        $this->phpstanTools->xdebug = true;
        $properties = $this->phpstanTools->setPropertiesConfiguration(
            [],
            $this->phpstanTools
        );
        $this->assertEquals(
            [
                'phpstan.enable' => true,
                'phpstan.level' => 'test',
                'phpstan.xdebug' => true,
            ],
            $properties
        );

        $this->phplocTools->isUsed = true;
        $properties = $this->phplocTools->setPropertiesConfiguration(
            [],
            $this->phplocTools
        );
        $this->assertEquals(
            [
                'phploc.enable' => true,
            ],
            $properties
        );
    }
}