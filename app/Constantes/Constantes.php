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

    const FOLDERS_EXCLUDE_BASE_DIR = [
        'vendor',
        'viduc',
        'orkin',
        'app',
        'Command',
        'Orkin',
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