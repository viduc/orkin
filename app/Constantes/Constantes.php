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

class Constantes
{
    const FOLDERS_EXCLUDE_BASE_DIR = [
        'vendor',
        'viduc',
        'orkin',
        'app',
        'Command',
        'Orkin',
        'Configuration',
        'Container',
        'Factory',
        'Models',
        'Translations',
        'Services',
        'Validators',
    ];

    const CONFIG_FILE = 'orkin.yml';
    const CONFIG_DEFAULT = [
        'newConfiguration' => true,
        'qualityPath' => 'quality',
    ];
}