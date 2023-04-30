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
    public string $configFile = 'tests/execution/config_test.yml';
    public string $qualityPath = 'tests/execution/quality';
    public string $folderExecution = 'tests/execution';
    public string $phingFolder = 'phing';
    public string $phingFile = 'build.xml';
    public Serializer $serializer;
    public Filesystem $filesystem;

    public function setUp(): void
    {
        parent::setUp();
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new YamlEncoder()]
        );
        $this->filesystem = new Filesystem();
        $this->cleanExecution();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->cleanExecution();
    }
    public function cleanExecution(): void
    {
        $this->filesystem->remove(
            Constantes::getProjectDir().$this->folderExecution
        );
        mkdir(Constantes::getProjectDir().$this->folderExecution);
    }
}