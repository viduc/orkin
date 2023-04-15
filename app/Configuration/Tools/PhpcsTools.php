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

class PhpcsTools extends ToolsAbstract
{
    final public function configure(): ModelInterface
    {
        $phpcs = $this->configurationsFactory->create(['model' => 'phpcs']);
        $phpcs->isUsed = $this->useTool(
            'phpcs',
            'phpcs use'
        );
        $phpcs->phpcb = $phpcs->isUsed ? $this->useTool(
            'Phcs phpcb',
            'phpcs phpcb'
        ): $phpcs->phpcb;

        return $phpcs;
    }

    final public function setPropertiesConfiguration(
        array $properties,
        ModelInterface $model
    ): array
    {
        $properties['phpcs.enable'] = $model->isUsed ? '1': '0';
        $properties['phpcs.phpcb'] = $model->phpcb ? '1': '0';

        return $properties;
    }
}