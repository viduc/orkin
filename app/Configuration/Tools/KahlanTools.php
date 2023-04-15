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

namespace Viduc\Orkin\Configuration\Tools;

use Viduc\Orkin\Models\ModelInterface;

class KahlanTools extends ToolsAbstract
{
    final public function configure(): ModelInterface
    {
        $kahlan = $this->configurationsFactory->create(['model' => 'kahlan']);
        $kahlan->isUsed = $this->useTool(
            'kahlan',
            'kahlan use'
        );
        $kahlan->folderSpec = $kahlan->isUsed ? $this->answer(
            'Kahlan folder spec',
            'kahlan spec',
            $kahlan->folderSpec
        ): $kahlan->folderSpec;
        $kahlan->reporterConsole = $kahlan->isUsed ? $this->answer(
            'Kahlan reporter console',
            'kahlan reporter console',
            $kahlan->reporterConsole
        ): $kahlan->reporterConsole;
        $kahlan->reporterCoverage = $kahlan->isUsed ? $this->answer(
            'Kahlan reporter coverage',
            'kahlan reporter coverage',
            $kahlan->reporterCoverage
        ): $kahlan->reporterCoverage;
        $kahlan->coverageLevel = $kahlan->isUsed ? $this->answerInteger(
            'Kahlan coverage level',
            'kahlan coverage level',
            $kahlan->coverageLevel
        ): $kahlan->coverageLevel;

        return $kahlan;
    }

    final public function setPropertiesConfiguration(
        array $properties,
        ModelInterface $model
    ): array
    {
        $properties['kahlan.enable'] = $model->isUsed;
        $properties['kahlan.spec'] = $model->folderSpec;
        $properties['kahlan.reporter.console'] = $model->reporterConsole;
        $properties['kahlan.reporter.coverage'] = $model->reporterCoverage;
        $properties['kahlan.reporter.coverage.level'] = $model->coverageLevel;

        return $properties;
    }
}