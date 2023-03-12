<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Translations;

use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Configuration\Configuration;

class Translation
{
    public Translator $translator;
    public function __construct(public Configuration $configuration, string $locale = 'en_US')
    {
        $this->translator = new Translator($locale);
        $this->translator->addLoader('yaml', new YamlFileLoader());
        $this->translator->addResource('yaml', $this->configuration->baseDir.'vendor/viduc/orkin/Translations/messages.en.yaml', $locale);
        var_dump($this->configuration->baseDir.'vendor/viduc/orkin/Translations/messages.en.yaml');
        var_dump(__DIR__);
    }
}