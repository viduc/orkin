<?php
/**
 * This file is part of the Api package.
 *
 * (c) GammaSoftware <http://www.winlassie.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Viduc\Orkin\Translation;

use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;

class Translation
{
    public Translator $translator;
    public function __construct(string $locale = 'en_US')
    {
        $this->translator = new Translator($locale);
        $this->translator->addLoader('yaml', new YamlFileLoader());
    }
}