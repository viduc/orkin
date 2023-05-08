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

use Minicli\Output\OutputHandler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Configuration\Configuration;
use Viduc\Orkin\Configuration\Manual;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ConfigurationsFactory;
use Viduc\Orkin\Factory\InputFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\FileSystem\IniFile;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Services\ProjectService;
use Viduc\Orkin\Translations\Translation;

abstract class ContainerConstantes
{
    public const DEFINITIONS = [
        self::FILE_SYSTEM,
        self::OUTPUT_HANDLER,
        self::YAML_ENCODER,
        self::OBJECT_NORMALIZER,
        self::CONFIGURATIONS_FACTORY,
        self::INPUT_FACTORY,
        self::INI_FILE,
        self::SERIALIZER,
        self::TRANSLATION,
        self::CONFIGURATION_FACTORY,
        self::QUESTIONS,
        self::TOOLS_FACTORY,
        self::CONFIGURATION,
        self::PROJECT_SERVICE,
        self::MANUAL
    ];
    public const FILE_SYSTEM = [
        'id' =>  'fileSystem',
        'class' => FileSystem::class,
        'dependencies' => []
    ];
    public const OUTPUT_HANDLER = [
        'id' => 'outputHandler',
        'class' => OutputHandler::class,
        'dependencies' => []
    ];
    public const CONFIGURATIONS_FACTORY = [
        'id' => 'configurationsFactory',
        'class' => ConfigurationsFactory::class,
        'dependencies' => []
    ];
    public const INPUT_FACTORY = [
        'id' => 'inputFactory',
        'class' => InputFactory::class,
        'dependencies' => []
    ];
    public const INI_FILE = [
        'id' => 'iniFile',
        'class' => IniFile::class,
        'dependencies' => []
    ];
    public const YAML_ENCODER = [
        'id' => 'yamlEncoder',
        'class' => YamlEncoder::class,
        'dependencies' => []
    ];
    public const OBJECT_NORMALIZER = [
        'id' => 'objectNormalizer',
        'class' => ObjectNormalizer::class,
        'dependencies' => []
    ];

    public const SERIALIZER = [
        'id' => 'serializer',
        'class' => Serializer::class,
        'dependencies' => [['objectNormalizer'], ['yamlEncoder']]
    ];
    public const TRANSLATION = [
        'id' => 'translation',
        'class' => Translation::class,
        'dependencies' => ['translator']
    ];
    public const CONFIGURATION_FACTORY = [
        'id' => 'configurationFactory',
        'class' => ConfigurationFactory::class,
        'dependencies' => ['serializer']
    ];
    public const QUESTIONS = [
        'id' => 'questions',
        'class' => Answers::class,
        'dependencies' => ['outputHandler', 'inputFactory']
    ];
    public const TOOLS_FACTORY = [
        'id' => 'toolsFactory',
        'class' => ToolsFactory::class,
        'dependencies' => [
            'questions',
            'configurationsFactory',
            'translation'
        ]
    ];
    public const CONFIGURATION = [
        'id' => 'configuration',
        'class' => Configuration::class,
        'dependencies' => [
            'configurationFactory',
            'serializer',
            'toolsFactory',
            'iniFile'
        ]
    ];
    public const PROJECT_SERVICE = [
        'id' => 'projectService',
        'class' => ProjectService::class,
        'dependencies' => [
            'configuration',
            'fileSystem',
        ]
    ];
    public const MANUAL = [
        'id' => 'manual',
        'class' => Manual::class,
        'dependencies' => [
            'questions',
            'translation',
            'toolsFactory',
            'configurationFactory',
        ]
    ];

}