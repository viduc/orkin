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

class PhpunitTools extends ToolsAbstract
{
    final public function configure(): ModelInterface
    {
        $phpunit = $this->configurationsFactory->create(['model' => 'phpunit']);
        $phpunit->isUsed = $this->useTool(
            'phpunit',
            'phpunit use'
        );
        $phpunit->folderTest = $phpunit->isUsed ? $this->answer(
            'Phpunit folder test',
            'phpunit folder',
            $phpunit->folderTest
        ): $phpunit->folderTest;

        return $phpunit;
    }

    final public function setPropertiesConfiguration(
        array $properties,
        ModelInterface $model
    ): array
    {
        $properties['phpunit.enable'] = $model->isUsed ? '1': '0';
        $properties['phpunit.folderTest'] = $model->folderTest;

        return $properties;
    }
}