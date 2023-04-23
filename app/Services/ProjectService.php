<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Services;

use Symfony\Component\Filesystem\Filesystem;
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Constantes\Constantes;

class ProjectService implements ServiceInterface
{
    public string $project = '';
    private string $root = '';

    public function __construct(
        public Configuration $configuration,
        private Filesystem $filesystem
    ) {
        $this->project = Constantes::getProjectDir();
        $this->root = Constantes::getOrkintDir();
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->filesystem->mirror(
            $this->root.$this->configuration->getPhingFolder(),
            $this->project.DIRECTORY_SEPARATOR.Constantes::FOLDER_PHING
        );
        $this->filesystem->copy(
            $this->root.$this->configuration->getPhingFile(),
            $this->project.DIRECTORY_SEPARATOR.Constantes::FILE_PHING
        );
    }
}
