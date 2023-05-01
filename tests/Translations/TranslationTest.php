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

namespace Viduc\Orkin\Tests\Translations;

use Symfony\Component\Translation\Translator;
use Viduc\Orkin\Tests\OrkinTestCase;
use Viduc\Orkin\Translations\Translation;

class TranslationTest extends OrkinTestCase
{
    private Translation $translation;
    private Translator $translator;

    public function setUp(): void
    {
        $this->translator = $this->createMock(Translator::class);
        $this->translator->method('addLoader')->willReturn(true);
        $this->translator->method('addResource')->willReturn(true);
        $this->translation = new Translation($this->translator);
    }

    public function testDefinelocale(): void
    {
        $this->assertEquals(
            'fr_FR',
            $this->translation->defineLocale('fr')
        );
        $this->assertEquals(
            'en_US',
            $this->translation->defineLocale('test')
        );
    }
}