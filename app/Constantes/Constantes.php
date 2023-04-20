<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Constantes;

abstract class Constantes
{
    public static function getProjectDir(): string
    {
        $path = '';
        if (str_contains(__DIR__, 'vendor')) {
            return explode('vendor', __DIR__)[0];
        }
        $dir = str_replace('vendor/viduc/orkin', '', __DIR__);
        foreach (array_diff(
            explode(DIRECTORY_SEPARATOR, $dir),
            self::FOLDERS_EXCLUDE_ROOT_DIR
        ) as $folder) {
            $path .= $folder.DIRECTORY_SEPARATOR;
        }

        return $path;
    }

    public static function getOrkintDir(): string
    {
        $path = '';
        foreach (array_diff(
            explode(DIRECTORY_SEPARATOR, __DIR__),
            Constantes::FOLDERS_EXCLUDE_ROOT_DIR
        ) as $folder) {
            $path .= $folder.DIRECTORY_SEPARATOR;
        }

        return $path;
    }

    public const FOLDERS_EXCLUDE_ROOT_DIR = [
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

    public const CONFIG_FILE = 'orkin.yml';
    public const FILE_PHING = 'build.xml';
    public const FOLDER_PHING = 'phing';
    public const FOLDER_QUALITY = 'quality';
    public const FOLDER_REPORTS = 'reports';
    public const FOLDER_SRC = 'src';
    public const BUILD_PROPERTIES = 'build.properties';
    public const LIST_TOOLS = [
        'phpunit',
        'kahlan',
        'phpcsfixer',
        'phpcs',
        'phpmd',
        'phpstan',
        'phploc',
    ];
    public const CONFIG_DEFAULT = [
        'newConfiguration' => true,
        'qualityPath' => self::FOLDER_QUALITY,
        'phingFolder' => self::FOLDER_PHING,
        'phingFile' => self::FILE_PHING,
        'reportsFolder' => self::FOLDER_REPORTS,
        'src' => self::FOLDER_SRC,
    ];
    public const CONFIG_KAHLAN = [
        'folderSpec' => 'spec',
        'reporterConsole' => 'dot',
        'reporterCoverage' => 'tap',
        'coverageLevel' => 4,
        'checkreturn' => 'true',
    ];
    public const CONFIG_PHPCSFIXER = [
        'dryrun' => true,
        'checkreturn' => 'true',
    ];
    public const CONFIG_PHPCS = [
        'phpcb' => true,
    ];
    public const CONFIG_PHPMD = [
        'mode' => 'cleancode',
        'reportType' => 'text',
        'reportFile' => 'phpmd.txt',
    ];
    public const CONFIG_PHPSTAN = [
        'level' => 7,
        'xdebug' => false,
    ];

    public const CONFIG_PHPUNIT = [
        'folderTest' => 'tests',
        'checkreturn' => 'true',
    ];
}
