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
use PHPUnit\Util\Filesystem;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Translations\Translation;

abstract class ContainerAbstract
{
    static public function getContainer(): Container
    {
        $container = new Container();
        self::registerContainer($container);

        return $container;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    static private function registerContainer(Container &$container): void
    {
        $container->add(
            'yamlEncoder',
            YamlEncoder::class
        );
        $container->add(
            'objectNormalizer',
            ObjectNormalizer::class
        );
        $container->add(
            'serializer',
            Serializer::class
        )->addArguments(
            [$container->get('objectNormalizer'), $container->get('yamlEncoder')]
        );
        $container->add(
            'fileSystem',
            Filesystem::class
        );


        $container->add(
            'configurationFactory',
            ConfigurationFactory::class
        );
        $container->add(
            'configuration', Configuration::class
        )->addArguments(
            [
                $container->get('configurationFactory'),
                $container->get('fileSystem')
            ]
        );

        $container->add(
            'translation',
            Translation::class
        )->addArguments(['en_US']);
    }
}