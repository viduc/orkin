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
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Factory\ContainerFactory;
use Viduc\Orkin\Models\ContainerModel;

class OrkinContainer
{
    private Container $container;
    public function getContainer(): Container
    {
        $this->container = new Container();
        $this->registerContainer();

        return $this->container;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function registerContainer(): void
    {
        $this->container->add(
            'translator',
            Translator::class
        )->addArguments(['en_US']);
        $this->container->add(
            'containerFactory',
            ContainerFactory::class
        );
        foreach ($this->container->get('containerFactory')->assembly() as $definition) {
            $this->container->add(
                $definition->name,
                $definition->class
            )->addArguments($this->getDependencies($definition));
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getDependencies(ContainerModel $definition): array
    {
        $dependencies = [];

        foreach ($definition->dependencies as $dependencie) {
            $dependencies[] = is_array($dependencie) ?
                [$this->container->get($dependencie[0])] :
                $this->container->get($dependencie);
        }

        return $dependencies;
    }
}
