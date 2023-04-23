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

class PhpstanTools extends ToolsAbstract
{
    final public function setPropertiesConfiguration(
        array $properties,
        ModelInterface $model
    ): array {
        $properties['phpstan.enable'] = $model->isUsed;
        $properties['phpstan.level'] = $model->level;
        $properties['phpstan.xdebug'] = $model->xdebug;

        return $properties;
    }
}
