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

/**
 * @covers \Viduc\Orkin\Configuration\Tools\TestTools
 */
class KahlanTools extends ToolsAbstract
{
    final public function setPropertiesConfiguration(
        array $properties,
        ModelInterface $model
    ): array {
        $properties['kahlan.enable'] = $model->isUsed;
        $properties['kahlan.checkreturn'] = $model->checkreturn;
        $properties['kahlan.spec'] = $model->folderSpec;
        $properties['kahlan.reporter.console'] = $model->reporterConsole;
        $properties['kahlan.reporter.coverage'] = $model->reporterCoverage;
        $properties['kahlan.reporter.coverage.level'] = $model->coverageLevel;

        return $properties;
    }
}
