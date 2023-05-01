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

namespace Viduc\Orkin\Tests\Factory;

use Viduc\Orkin\Factory\ContainerFactory;
use Viduc\Orkin\Tests\OrkinTestCase;

class ContainerFactoryTest extends OrkinTestCase
{
    private ContainerFactory $containerFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->containerFactory = new ContainerFactory();
    }

    public function testCreate(): void
    {
        $container = $this->containerFactory->create(
            [
                'name' => 'test',
                'class' => 'test',
                'dependencies' => ['test']
            ]
        );
        $this->assertInstanceOf(
            'Viduc\Orkin\Models\ContainerModel',
            $container
        );
    }

    public function testCreateWithoutName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('ContainerConstantes name is required');
        $this->containerFactory->create(
            [
                'class' => 'test',
                'dependencies' => ['test']
            ]
        );
    }

    public function testCreateWithoutClass(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('ContainerConstantes class is required');
        $this->containerFactory->create(
            [
                'name' => 'test',
                'dependencies' => ['test']
            ]
        );
    }

    public function testCreateWithoutDependencies(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('ContainerConstantes dependencies is required');
        $this->containerFactory->create(
            [
                'name' => 'test',
                'class' => 'test'
            ]
        );
    }

    public function testAssembly(): void
    {
        $containers = $this->containerFactory->assembly();
        $this->assertIsArray($containers);
    }
}