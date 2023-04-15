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

class PhpmdTools extends ToolsAbstract
{
    final public function configure(): ModelInterface
    {
        $phpmd = $this->configurationsFactory->create(['model' => 'phpmd']);
        $phpmd->isUsed = $this->useTool(
            'phpmd',
            'phpmd use'
        );
        $phpmd->mode = $phpmd->isUsed ? $this->answer(
            'Phpmd mode',
            'phpmd mode',
            $phpmd->mode
        ): $phpmd->mode;
        $phpmd->mode = $phpmd->isUsed ? $this->answer(
            'Phpmd report type',
            'phpmd report type',
            $phpmd->mode
        ): $phpmd->mode;
        $phpmd->reportFile = $phpmd->isUsed ? $this->answer(
            'Phpmd report file',
            'phpmd report file',
            $phpmd->reportFile
        ): $phpmd->reportFile;

        return $phpmd;
    }

    final public function setPropertiesConfiguration(
        array $properties,
        ModelInterface $model
    ): array
    {
        $properties['phpmd.enable'] = $model->isUsed;
        $properties['phpmd.mode'] = $model->mode;
        $properties['phpmd.reportType'] = $model->reportType;
        $properties['phpmd.reportFile'] = $model->reportFile;

        return $properties;
    }
}