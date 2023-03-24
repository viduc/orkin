<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Constantes;

abstract class Constantes
{
    /**
     * @return string
     */
    static public function getProjectDir(): string
    {
        $path = '';
        if (str_contains(__DIR__, 'vendor')) {
            return explode('vendor', __DIR__)[0];
        }
        $dir = str_replace('vendor/viduc/orkin', '', __DIR__);
        foreach(array_diff(
                    explode(DIRECTORY_SEPARATOR, $dir),
                    self::FOLDERS_EXCLUDE_ROOT_DIR
                ) as $folder) {
            $path .= $folder.DIRECTORY_SEPARATOR;
        }

        return $path;
    }

    /**
     * @return string
     */
    static public function getOrkintDir(): string
    {
        $path = '';
        foreach(array_diff(
                    explode(DIRECTORY_SEPARATOR, __DIR__),
                    Constantes::FOLDERS_EXCLUDE_ROOT_DIR
                ) as $folder) {
            $path .= $folder.DIRECTORY_SEPARATOR;
        }

        return $path;
    }

    const FOLDERS_EXCLUDE_ROOT_DIR = [
        'app',
        'Command',
        'Configuration',
        'Constantes',
        'Container',
        'Factory',
        'Models',
        'Translations',
        'Services',
        'Validators',
    ];

    const CONFIG_FILE = 'orkin.yml';
    const FOLDER_PHING = 'phing';
    const FILE_PHING = 'build.xml';
    const CONFIG_DEFAULT = [
        'newConfiguration' => true,
        'qualityPath' => 'quality',
        'phingFolder' => self::FOLDER_PHING,
        'phingFile' => self::FILE_PHING,
    ];

}