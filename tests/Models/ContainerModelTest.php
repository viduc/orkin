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

namespace Viduc\Orkin\Tests\Models;

use Symfony\Component\Filesystem\Filesystem;
use Viduc\Orkin\Models\ContainerModel;
use Viduc\Orkin\Tests\OrkinTestCase;

class ContainerModelTest extends OrkinTestCase
{
    private ContainerModel $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new ContainerModel(
            'fileSystem',
            FileSystem::class
        );
    }

    public function testHasDependencie(): void
    {
        $this->model->addDependency('test');
        $this->assertTrue($this->model->hasDependencie('test'));
    }


}