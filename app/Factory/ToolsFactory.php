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

    public function create(array $params = []): ModelInterface
    {
        switch ($params['tool']) {
        default:
            return new PhpunitTools(
                $this->answers,
                $this->configurationsFactory,
                $this->translation,
                $this->locale
            );
        case 'kahlan':
            return new KahlanTools(
                $this->answers,
                $this->configurationsFactory,
                $this->translation,
                $this->locale
            );
        case 'phpcsfixer':
            return new PhpcsfixerTools(
                $this->answers,
                $this->configurationsFactory,
                $this->translation,
                $this->locale
            );
        case 'phpcs':
            return new PhpcsTools(
                $this->answers,
                $this->configurationsFactory,
                $this->translation,
                $this->locale
            );
        case 'phpmd':
            return new PhpmdTools(
                $this->answers,
                $this->configurationsFactory,
                $this->translation,
                $this->locale
            );
        case 'phpstan':
            return new PhpstanTools(
                $this->answers,
                $this->configurationsFactory,
                $this->translation,
                $this->locale
            );
        case 'phploc':
            return new PhplocTools(
                $this->answers,
                $this->configurationsFactory,
                $this->translation,
                $this->locale
            );
        }
    }
}
