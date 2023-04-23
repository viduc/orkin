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

namespace Viduc\Orkin\Factory;

use Viduc\Orkin\Configuration\Tools\KahlanTools;
use Viduc\Orkin\Configuration\Tools\PhpcsfixerTools;
use Viduc\Orkin\Configuration\Tools\PhpcsTools;
use Viduc\Orkin\Configuration\Tools\PhplocTools;
use Viduc\Orkin\Configuration\Tools\PhpmdTools;
use Viduc\Orkin\Configuration\Tools\PhpstanTools;
use Viduc\Orkin\Configuration\Tools\PhpunitTools;
use Viduc\Orkin\Models\ModelInterface;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Translations\Translation;

class ToolsFactory implements FactoryInterface
{
    public string $locale = 'en_US';

    public function __construct(
        public Answers $answers,
        private ConfigurationsFactory $configurationsFactory,
        private Translation $translation
    ) {
    }

    /**
     * @param array $params
     * @return ModelInterface
     */
    public function create(array $params = []): ModelInterface
    {
        return match ($params['tool']) {
        'phpunit' => $this->instanciate(PhpunitTools::class),
        'kahlan' => $this->instanciate(KahlanTools::class),
        'phpcsfixer' =>$this->instanciate(PhpcsfixerTools::class),
        'phpcs' => $this->instanciate(PhpcsTools::class),
        'phpmd' => $this->instanciate(PhpmdTools::class),
        'phpstan' => $this->instanciate(PhpstanTools::class),
        'phploc' => $this->instanciate(PhplocTools::class)
        };
    }

    /**
     * @param string $tool
     * @return mixed
     */
    private function instanciate(string $tool): mixed
    {
        return new $tool(
            $this->answers,
            $this->configurationsFactory,
            $this->translation,
            $this->locale
        );
    }
}
