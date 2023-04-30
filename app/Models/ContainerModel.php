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

namespace Viduc\Orkin\Models;

class ContainerModel implements ModelInterface
{
    public string $name;
    public string $class;

    public array $dependencies;

    public function __construct(string $name, string $class, array $dependencies = [])
    {
        $this->name = $name;
        $this->class = $class;
        $this->dependencies = $dependencies;
    }

    /**
     * @param  string $dependencie
     * @return bool
     */
    public function hasDependencie(string $dependencie): bool
    {
        return isset($this->dependencies[$dependencie]);
    }

    /**
     * @param  string $dependency
     * @return void
     */
    public function addDependency(string $dependency): void
    {
        if (!$this->hasDependencie($dependency)) {
            $this->dependencies[$dependency] = $dependency;
        }
    }
}