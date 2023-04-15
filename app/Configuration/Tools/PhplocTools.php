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

class PhplocTools extends ToolsAbstract
{
    final public function configure(): ModelInterface
    {
        $phploc = $this->configurationsFactory->create(['model' => 'phploc']);
        $phploc->isUsed = $this->useTool(
            'phploc',
            'phploc use'
        );
        return $phploc;
    }

    final public function setPropertiesConfiguration(
        array $properties,
        ModelInterface $model
    ): array
    {
        $properties['phploc.enable'] = $model->isUsed ? '1': '0';

        return $properties;
    }
}