<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Constantes\Constantes;

class OrkinTestCase extends TestCase
{
    public string $configFile = 'orkin/tests/execution/config_test.yml';
    public string $qualityPath = 'orkin/tests/execution/quality';
    public string $folderExecution = 'orkin/tests/execution';
    public string $phingFolder = 'orkin/phing';
    public string $phingFile = 'orkin/build.xml';
    public Serializer $serializer;
    public Filesystem $filesystem;

    public function __construct()
    {
        parent::__construct();
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new YamlEncoder()]
        );
        $this->filesystem = new Filesystem();
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->cleanExecution();
    }
    public function cleanExecution(): void
    {
        $this->filesystem->remove(
            Constantes::getRootDir().$this->folderExecution
        );
        mkdir(Constantes::getRootDir().$this->folderExecution);
    }
}