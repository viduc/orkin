<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Factory;

use Viduc\Orkin\Models\InputModel;

class InputFactory implements FactoryInterface
{
    /**
     * @param  array $params
     * @return InputModel
     */
    public function create(array $params = []): InputModel
    {
        return new InputModel($params['message']);
    }
}
