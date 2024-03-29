<?php

declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP.
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Translations;

use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;

class Translation
{
    public const LOCALE = [
        'fr' => 'fr_FR',
        'en' => 'en_US',
    ];

    public const DEFAULT_LOCALE = 'en_US';

    public function __construct(public Translator $translator)
    {
        $this->translator->addLoader('yaml', new YamlFileLoader());
        $this->translator->addResource(
            'yaml',
            __DIR__.'/messages.en.yaml',
            'en_US'
        );
        $this->translator->addResource(
            'yaml',
            __DIR__.'/messages.fr.yaml',
            'fr_FR'
        );
    }

    public function defineLocale(string $locale): string
    {
        return array_key_exists(
            $locale,
            self::LOCALE
        ) ? self::LOCALE[$locale] : self::DEFAULT_LOCALE;
    }
}
