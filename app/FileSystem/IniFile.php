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

namespace Viduc\Orkin\FileSystem;

class IniFile
{
    public function writeIniFile(array $config, string $file): void
    {
        $fileContent = '';
        foreach ($config as $key => $value) {
            $fileContent .= is_array($value) ?
                $this->addArrayContent($fileContent, $key, $value) :
                "$key=".$this->formatValue($value).PHP_EOL;
        }

        file_put_contents($file, $fileContent, LOCK_EX);
    }

    private function addArrayContent(
        string $content,
        string $index,
        array $value
    ): string {
        foreach ($value as $t => $m) {
            $content .= "$index[$t]=".$this->formatValue($m).PHP_EOL;
        }

        return $content;
    }

    private function formatValue(mixed $value): string|int
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return $value;
    }
}