<?php
/**
 * This file is part of the Api package.
 *
 * (c) GammaSoftware <http://www.winlassie.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Viduc\Orkin\Configuration;

use League\Container\Container;

class Configuration
{
    public string $baseDir = '';
    public function __construct()
    {
        $this->baseDir = str_replace(
            ['vendor/viduc/orkin/app/', 'Command', 'Orkin', 'Configuration'],
            '',
            __dir__
        );
    }

    public function isConfigurationAlreadyExist(): bool
    {
        return file_exists($this->baseDir . '.orkin.yaml');
    }
}