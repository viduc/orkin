<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Services;

use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Exceptions\FolderException;

abstract class FolderServiceAbstract implements ServiceInterface
{
    /**
     * @param string $name
     * @return void
     * @throws FolderException
     */
    static public function create(string $name): void
    {
        if (is_dir(self::getRootDir().$name) ||
            false === mkdir(self::getRootDir().$name)
        ) {
            throw new FolderException(
                "The folder  ".$name." already exists",
                102
            );
        }
    }

    /**
     * @param string $dir
     * @return void
     */
    static public function delete(string $dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir.DIRECTORY_SEPARATOR.$object) &&
                        !is_link($dir.DIRECTORY_SEPARATOR.$object))
                        self::delete($dir.DIRECTORY_SEPARATOR.$object);
                    else
                        unlink($dir.DIRECTORY_SEPARATOR.$object);
                }
            }
            rmdir($dir);
        }
    }

    /**
     * @return string
     */
    static public function getRootDir(): string
    {
        $path = '';
        foreach(array_diff(
            explode(DIRECTORY_SEPARATOR, __DIR__),
            Constantes::FOLDERS_EXCLUDE_BASE_DIR
        ) as $folder) {
            $path .= $folder.DIRECTORY_SEPARATOR;
        }

        return $path;
    }
}