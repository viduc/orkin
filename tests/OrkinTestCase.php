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
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Services\FolderServiceAbstract;

class OrkinTestCase extends TestCase
{
    public string $configFile = 'orkin/tests/execution/config_test.yml';
    public string $qualityPath = 'orkin/tests/execution/quality';
    public string $folderExecution = 'orkin/tests/execution';
    public Serializer $serializer;

    public function setUp(): void
    {
        parent::setUp();
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new YamlEncoder()]
        );
        $this->cleanExecution();
    }
    public function cleanExecution(): void
    {
        FolderServiceAbstract::delete(
            FolderServiceAbstract::getRootDir().$this->folderExecution
        );
        mkdir(FolderServiceAbstract::getRootDir().$this->folderExecution);
    }
}