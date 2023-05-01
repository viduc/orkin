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

namespace Viduc\Orkin\Tests\Container;

use League\Container\Container;
use Viduc\Orkin\Container\OrkinContainer;
use Viduc\Orkin\Tests\OrkinTestCase;

class OrkinContainerTest extends OrkinTestCase
{
    private OrkinContainer $container;

    public function setUp(): void
    {
        parent::setUp();
        $this->container = new OrkinContainer();
    }

    public function testGetContainer(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->container->getContainer()
        );
    }
}