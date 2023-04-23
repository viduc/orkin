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

namespace Viduc\Orkin\Factory;

use Viduc\Orkin\Constantes\ContainerConstantes;
use Viduc\Orkin\Models\ContainerModel;

class ContainerFactory implements FactoryInterface
{
    /**
     * @param array $params
     * @return ContainerModel
     */
    public function create(array $params = []): ContainerModel
    {
        if (!isset($params['name'])) {
            throw new \InvalidArgumentException(
                'ContainerConstantes name is required'
            );
        }
        if (!isset($params['class'])) {
            throw new \InvalidArgumentException(
                'ContainerConstantes class is required'
            );
        }
        if (!isset($params['dependencies'])) {
            throw new \InvalidArgumentException(
                'ContainerConstantes dependencies is required'
            );
        }

        return new ContainerModel($params['name'], $params['class'], $params['dependencies']);
    }

    /**
     * @return array
     */
    public function assembly(): array
    {
        $containers = [];
        foreach (ContainerConstantes::DEFINITIONS as $definition) {
            $containers[$definition['id']] = $this->create(
                [
                    'name' => $definition['id'],
                    'class' => $definition['class'],
                    'dependencies' => $definition['dependencies']
                ]
            );
        }

        return $containers;
    }
}