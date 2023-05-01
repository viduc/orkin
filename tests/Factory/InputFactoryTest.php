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

use Viduc\Orkin\Factory\InputFactory;
use Viduc\Orkin\Tests\OrkinTestCase;

class InputFactoryTest extends OrkinTestCase
{
    private InputFactory $factory;

    public function setUp(): void
    {
        $this->factory = new InputFactory();
    }

    public function testCreate(): void
    {
        $this->assertEquals(
            'test',
            $this->factory->create(['message' => 'test'])->getPrompt()
        );
    }
}