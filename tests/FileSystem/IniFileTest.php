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

namespace Viduc\Orkin\Tests\FileSystem;

use Viduc\Orkin\FileSystem\IniFile;
use Viduc\Orkin\Tests\OrkinTestCase;

/**
 * @covers IniFile
 */
class IniFileTest extends OrkinTestCase
{
    private IniFile $iniFile;
    public function setUp(): void
    {
        parent::setUp();
        $this->iniFile = new IniFile();
    }

    public function testWriteIniFile(): void
    {
        $config = [
            'test' => 'test',
            'test2' => 'test2',
            'test3' => [
                'test4' => 'test4',
                'test5' => 'test5',
            ],
        ];

        $file = str_replace('FileSystem', 'execution', __DIR__).'/test.ini';
        $this->iniFile->writeIniFile($config, $file);
        $this->assertFileExists($file);
        $this->assertStringContainsString('test=test', file_get_contents($file));
        $this->assertStringContainsString('test2=test2', file_get_contents($file));
        $this->assertStringContainsString('test3.test4=test4', file_get_contents($file));
        $this->assertStringContainsString('test3.test5=test5', file_get_contents($file));
        unlink($file);
    }
}