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
use Minicli\Output\OutputHandler;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Command\Configuration\ManualController;
use Viduc\Orkin\Command\Orkin\CreateController;
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Configuration\Manual;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Factory\InputFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Services\ProjectService;
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
        $container->add('yamlEncoder', YamlEncoder::class);
        $container->add('objectNormalizer',ObjectNormalizer::class);
        $container->add('fileSystem',Filesystem::class);
        $container->add('inputFactory',InputFactory::class);
        $container->add('outputHandler',OutputHandler::class);
        $container->add('configurationsFactory',ConfigurationsFactory::class);

        $container->add(
            'translator',
            Translator::class
        )->addArguments(['en_US']);
        $container->add(
            'translation',
            Translation::class
        )->addArguments([$container->get('translator')]);
        $container->add(
            'serializer',
            Serializer::class
        )->addArguments(
            [
                [$container->get('objectNormalizer')],
                [$container->get('yamlEncoder')]
            ]
        );

        $container->add(
            'configurationFactory',
            ConfigurationFactory::class
        )->addArguments([$container->get('serializer')]);
        $container->add(
            'questions',
            Answers::class
        )->addArguments(
            [
                $container->get('outputHandler'),
                $container->get('inputFactory'),
            ]
        );
        $container->add(
            'toolsFactory',
            ToolsFactory::class
        )->addArguments(
            [
                $container->get('questions'),
                $container->get('configurationsFactory'),
                $container->get('translation'),
            ]
        );
        $container->add(
            'configuration', Configuration::class
        )->addArguments(
            [
                $container->get('configurationFactory'),
                $container->get('serializer'),
                $container->get('toolsFactory')
            ]
        );
        $container->add(
            'projectService',
            ProjectService::class
        )->addArguments(
            [
                $container->get('configuration'),
                $container->get('fileSystem')
            ]
        );
        $container->add(
            'manual',
            Manual::class
        )->addArguments(
            [
                $container->get('questions'),
                $container->get('translation'),
                $container->get('toolsFactory'),
                $container->get('configurationFactory'),
            ]
        );
    }
}