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

namespace Viduc\Orkin\Constantes;

use Viduc\Orkin\Models\Configurations\KahlanModel;
use Viduc\Orkin\Models\Configurations\PhpcsfixerModel;
use Viduc\Orkin\Models\Configurations\PhpcsModel;
use Viduc\Orkin\Models\Configurations\PhplocModel;
use Viduc\Orkin\Models\Configurations\PhpmdModel;
use Viduc\Orkin\Models\Configurations\PhpstanModel;
use Viduc\Orkin\Models\Configurations\PhpunitModel;

class ToolsConstantes
{
    public const LIST_TOOLS = [
        'phpunit',
        'kahlan',
        'phpcsfixer',
        'phpcs',
        'phpmd',
        'phpstan',
        'phploc',
    ];

    public const LIST_TOOLS_MODEL = [
        'phpunit' => PhpunitModel::class,
        'kahlan' => KahlanModel::class,
        'phpcsfixer' => PhpcsfixerModel::class,
        'phpcs' => PhpcsModel::class,
        'phpmd' => PhpmdModel::class,
        'phpstan' => PhpstanModel::class,
        'phploc' => PhplocModel::class,
    ];

    public const TYPE_USE_TOOL = 'useTool';
    public const TYPE_USE_TOOL_STRING = 'useToolString';
    public const TYPE_ANSWER = 'answer';
    public const TYPE_ANSWER_INTEGER = 'answerInteger';
    public const CONFIG_KAHLAN = [
        'folderSpec' => 'spec',
        'reporterConsole' => 'dot',
        'reporterCoverage' => 'tap',
        'coverageLevel' => 4,
        'checkreturn' => 'true',
    ];
    public const CONFIGURE_KAHLAN_TOOL = [
        'isUsed' => [
            'identifier' => 'use',
            'translate' => 'use',
            'type' => self::TYPE_USE_TOOL
        ],
        'checkreturn' => [
            'identifier' => 'checkreturn',
            'translate' => 'checkreturn',
            'type' => self::TYPE_USE_TOOL_STRING
        ],
        'folderSpec' => [
            'identifier' => 'folder spec',
            'translate' => 'spec',
            'type' => self::TYPE_ANSWER
        ],
        'reporterConsole' => [
            'identifier' => 'reporter console',
            'translate' => 'reporter console',
            'type' => self::TYPE_ANSWER
        ],
        'reporterCoverage' => [
            'identifier' => 'reporter coverage',
            'translate' => 'reporter coverage',
            'type' => self::TYPE_ANSWER
        ],
        'coverageLevel' => [
            'identifier' => 'coverage level',
            'translate' => 'coverage level',
            'type' => self::TYPE_ANSWER_INTEGER
        ],
    ];
    public const CONFIG_PHPCSFIXER = [
        'dryrun' => true,
        'checkreturn' => 'true',
    ];
    public const CONFIGURE_PHPCSFIXER_TOOL = [
        'isUsed' => [
            'identifier' => 'use',
            'translate' => 'use',
            'type' => self::TYPE_USE_TOOL
        ],
        'dryrun' => [
            'identifier' => 'dryrun',
            'translate' => 'dryrun',
            'type' => self::TYPE_USE_TOOL_STRING
        ],
        'checkreturn' => [
            'identifier' => 'checkreturn',
            'translate' => 'checkreturn',
            'type' => self::TYPE_USE_TOOL_STRING
        ],
    ];
    public const CONFIG_PHPCS = [
        'phpcb' => true,
    ];
    public const CONFIGURE_PHPCS_TOOL = [
        'isUsed' => [
            'identifier' => 'use',
            'translate' => 'use',
            'type' => self::TYPE_USE_TOOL
        ],
        'phpcb' => [
            'identifier' => 'phpcb',
            'translate' => 'phpcb',
            'type' => self::TYPE_USE_TOOL
        ],
    ];
    public const CONFIGURE_PHPLOC_TOOL = [
        'isUsed' => [
            'identifier' => 'use',
            'translate' => 'use',
            'type' => self::TYPE_USE_TOOL
        ],
    ];

    public const CONFIG_PHPMD = [
        'mode' => 'cleancode',
        'reportType' => 'text',
        'reportFile' => 'phpmd.txt',
    ];
    public const CONFIGURE_PHPMD_TOOL = [
        'isUsed' => [
            'identifier' => 'use',
            'translate' => 'use',
            'type' => self::TYPE_USE_TOOL
        ],
        'mode' => [
            'identifier' => 'mode',
            'translate' => 'mode',
            'type' => self::TYPE_ANSWER
        ],
        'reportType' => [
            'identifier' => 'report type',
            'translate' => 'report type',
            'type' => self::TYPE_ANSWER
        ],
        'reportFile' => [
            'identifier' => 'report file',
            'translate' => 'report file',
            'type' => self::TYPE_ANSWER
        ],
    ];
    public const CONFIG_PHPSTAN = [
        'level' => 7,
        'xdebug' => false,
    ];
    public const CONFIGURE_PHPSTAN_TOOL = [
        'isUsed' => [
            'identifier' => 'use',
            'translate' => 'use',
            'type' => self::TYPE_USE_TOOL
        ],
        'level' => [
            'identifier' => 'level',
            'translate' => 'level',
            'type' => self::TYPE_ANSWER_INTEGER
        ],
        'xdebug' => [
            'identifier' => 'xdebug',
            'translate' => 'xdebug',
            'type' => self::TYPE_USE_TOOL
        ],
    ];
    public const CONFIG_PHPUNIT = [
        'folderTest' => 'tests',
        'checkreturn' => 'true',
    ];
    public const CONFIGURE_PHPUNIT_TOOL = [
        'isUsed' => [
            'identifier' => 'use',
            'translate' => 'use',
            'type' => self::TYPE_USE_TOOL
        ],
        'checkreturn' => [
            'identifier' => 'checkreturn',
            'translate' => 'checkreturn',
            'type' => self::TYPE_USE_TOOL_STRING
        ],
        'folderTest' => [
            'identifier' => 'folder test',
            'translate' => 'folder',
            'type' => self::TYPE_ANSWER
        ],
    ];
}