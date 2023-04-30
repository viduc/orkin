<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests\DataProviders;

use Viduc\Orkin\Constantes\ToolsConstantes;
use Viduc\Orkin\Models\Configurations\KahlanModel;
use Viduc\Orkin\Models\Configurations\PhpcsfixerModel;
use Viduc\Orkin\Models\Configurations\PhpcsModel;
use Viduc\Orkin\Models\Configurations\PhplocModel;
use Viduc\Orkin\Models\Configurations\PhpmdModel;
use Viduc\Orkin\Models\Configurations\PhpstanModel;
use Viduc\Orkin\Models\Configurations\PhpunitModel;

class ToolsDataProvider
{
    public function toolsDataProvider(): array
    {
        $phpunit = new PhpunitModel();
        $phpunit->isUsed = true;
        $phpunit->checkreturn = 'true';
        $phpunit->folderTest = 'test';

        $kahlan = new KahlanModel();
        $kahlan->isUsed = true;
        $kahlan->checkreturn = 'true';
        $kahlan->folderSpec = 'spec';
        $kahlan->reporterConsole = 'dot';
        $kahlan->reporterCoverage = 'tap';
        $kahlan->coverageLevel = 4;

        $phpcsfixer = new PhpcsfixerModel();
        $phpcsfixer->isUsed = true;
        $phpcsfixer->checkreturn = 'true';
        $phpcsfixer->dryRun = true;

        $phpcs = new PhpcsModel();
        $phpcs->isUsed = true;
        $phpcs->phpcb = true;

        $phpmd = new PhpmdModel();
        $phpmd->isUsed = true;
        $phpmd->mode = 'test';
        $phpmd->reportType = 'test';
        $phpmd->reportFile = 'test';

        $phpstan = new PhpstanModel();
        $phpstan->isUsed = true;
        $phpstan->level = 4;
        $phpstan->xdebug = true;

        $phploc = new PhplocModel();
        $phploc->isUsed = true;

        $tools[] = [
            'phpunit' => [
                'model' => $phpunit,
                'expected' => [
                    'phpunit.enable' => true,
                    'phpunit.checkreturn' => true,
                    'phpunit.folderTest' => 'test'
                ]
            ],
            'kahlan' => [
                'model' => $kahlan,
                'expected' => [
                    'kahlan.enable' => true,
                    'kahlan.checkreturn' => true,
                    'kahlan.spec' => 'spec',
                    'kahlan.reporter.console' => 'dot',
                    'kahlan.reporter.coverage' => 'tap',
                    'kahlan.reporter.coverage.level' => 4
                ]
            ],
            'phpcsfixer' => [
                'model' => $phpcsfixer,
                'expected' => [
                    'phpcsfixer.enable' => true,
                    'phpcsfixer.checkreturn' => true,
                    'phpcsfixer.dryrun' => true
                ]
            ],
            'phpcs' => [
                'model' => $phpcs,
                'expected' => [
                    'phpcs.enable' => true,
                    'phpcs.phpcb' => true
                ]
            ],
            'phpmd' => [
                'model' => $phpmd,
                'expected' => [
                    'phpmd.enable' => true,
                    'phpmd.mode' => 'test',
                    'phpmd.reportType' => 'test',
                    'phpmd.reportFile' => 'test'
                ]
            ],
            'phpstan' => [
                'model' => $phpstan,
                'expected' => [
                    'phpstan.enable' => true,
                    'phpstan.level' => 4,
                    'phpstan.xdebug' => true
                ]
            ],
            'phploc' => [
                'model' => $phploc,
                'expected' => [
                    'phploc.enable' => true
                ]
            ]
        ];


        return [
            $tools
        ];
    }
}