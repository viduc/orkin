<?php
/**
 * This file is part of the Api package.
 *
 * (c) GammaSoftware <http://www.winlassie.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Viduc\Orkin\Container;

use League\Container\Container;
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Translations\Translation;

abstract class ContainerAbstract
{
    static public function getContainer(): Container
    {
        $container = new Container();
        self::registerContainer($container);

        return $container;
    }

    static private function registerContainer(Container &$container): void
    {
        $container->add('configuration', Configuration::class);
        $container->add(
            'translation',
            Translation::class
        )->addArguments(['en_US']);
    }
}