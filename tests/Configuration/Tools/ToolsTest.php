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
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Models\Configurations\KahlanModel;
use Viduc\Orkin\Models\Configurations\PhpcsModel;
use Viduc\Orkin\Models\Configurations\PhplocModel;
use Viduc\Orkin\Models\Configurations\PhpmdModel;
use Viduc\Orkin\Models\Configurations\PhpstanModel;
use Viduc\Orkin\Models\Configurations\PhpunitModel;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Tests\OrkinTestCase;
use Viduc\Orkin\Translations\Translation;

class ToolsTest extends OrkinTestCase
{
    private Answers $answers;
    private ConfigurationsFactory $configurationsFactory;
    private Translation $translation;
    private PhpunitTools $phpunitTools;
    private KahlanTools $kahlanTools;
    private PhpcsfixerTools $phpcsfixerTools;
    private PhpcsTools $phpcsTools;
    private PhpmdTools $phpmdTools;
    private PhpstanTools $phpstanTools;
    private PhplocTools $phplocTools;

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
        $kahlan = new KahlanModel();
        $kahlan->isUsed = true;
        $kahlan->checkreturn = 'true';
        $kahlan->folderSpec = 'test';
        $kahlan->reporterConsole = 'test';
        $kahlan->reporterCoverage = 'test';
        $kahlan->coverageLevel = 1;

        $properties = $this->kahlanTools->setPropertiesConfiguration(
            [],
            $kahlan
        );

        $this->assertEquals(
            [
                'kahlan.enable' => true,
                'kahlan.checkreturn' => true,
                'kahlan.spec' => 'test',
                'kahlan.reporter.console' => 'test',
                'kahlan.reporter.coverage' => 'test',
                'kahlan.reporter.coverage.level' => 1,
            ],
            $properties
        );

        $phpunit = new PhpunitModel();
        $phpunit->isUsed = true;
        $phpunit->checkreturn = 'true';
        $phpunit->folderTest = 'test';
        $properties = $this->phpunitTools->setPropertiesConfiguration(
            [],
            $phpunit
        );
        $this->assertEquals(
            [
                'phpunit.enable' => true,
                'phpunit.checkreturn' => true,
                'phpunit.folderTest' => 'test'
            ],
            $properties
        );

        $phpcsfixer = new PhpunitModel();
        $phpcsfixer->isUsed = true;
        $phpcsfixer->checkreturn = 'true';
        $phpcsfixer->dryRun = 'true';
        $properties = $this->phpcsfixerTools->setPropertiesConfiguration(
            [],
            $phpcsfixer
        );
        $this->assertEquals(
            [
                'phpcsfixer.enable' => true,
                'phpcsfixer.checkreturn' => true,
                'phpcsfixer.dryrun' => true
            ],
            $properties
        );

        $phpcs = new PhpcsModel();
        $phpcs->isUsed = true;
        $phpcs->phpcb = true;
        $properties = $this->phpcsTools->setPropertiesConfiguration(
            [],
            $phpcs
        );
        $this->assertEquals(
            [
                'phpcs.enable' => true,
                'phpcs.phpcb' => true
            ],
            $properties
        );

        $phpmd = new PhpmdModel();
        $phpmd->isUsed = true;
        $phpmd->mode = 'test';
        $phpmd->reportType = 'test';
        $phpmd->reportFile = 'test';
        $properties = $this->phpmdTools->setPropertiesConfiguration(
            [],
            $phpmd
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

        $phpstan = new PhpstanModel();
        $phpstan->isUsed = true;
        $phpstan->level = 1;
        $phpstan->xdebug = true;
        $properties = $this->phpstanTools->setPropertiesConfiguration(
            [],
            $phpstan
        );
        $this->assertEquals(
            [
                'phpstan.enable' => true,
                'phpstan.level' => '1',
                'phpstan.xdebug' => true,
            ],
            $properties
        );

        $phploc = new PhplocModel();
        $phploc->isUsed = true;
        $properties = $this->phplocTools->setPropertiesConfiguration(
            [],
            $phploc
        );
        $this->assertEquals(
            [
                'phploc.enable' => true,
            ],
            $properties
        );
    }
}