<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Tests\Services;

use PHPUnit\Framework\TestCase;
use Viduc\Orkin\Services\FolderServiceAbstract;

class FolderServiceAbstractTest extends TestCase
{
    private string $rootDir = '';

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $ds = DIRECTORY_SEPARATOR;
        $this->rootDir = str_replace(
            'orkin'.$ds.'tests'.$ds.'Services',
            '',
            __DIR__
        );
    }

    public function setUp(): void
    {
        parent::setUp();
        if (is_dir($this->rootDir.'orkin/testcreate')) {
            rmdir($this->rootDir.'orkin/testcreate');
        }
    }

    public function testCreate()
    {
        FolderServiceAbstract::create('orkin/testcreate');
        $this->assertTrue(is_dir($this->rootDir.'orkin/testcreate'));
    }

    public function testGetRootDir()
    {
        $this->assertEquals(
            $this->rootDir,
            FolderServiceAbstract::getRootDir()
        );
    }
}