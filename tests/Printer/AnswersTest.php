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

namespace Viduc\Orkin\Tests\Printer;

use Minicli\Input;
use Minicli\Output\OutputHandler;
use Viduc\Orkin\Factory\InputFactory;
use Viduc\Orkin\Models\InputModel;
use Viduc\Orkin\Printer\Answers;
use Viduc\Orkin\Tests\OrkinTestCase;

class AnswersTest extends OrkinTestCase
{
    private Answers $answers;
    private OutputHandler $printer;
    private InputFactory $inputFactory;
    private InputModel $input;

    public function setUp(): void
    {
        parent::setUp();
        $this->printer = $this->createMock(OutputHandler::class);
        $this->printer->method('display')->willReturnSelf();
        $this->inputFactory = $this->createMock(InputFactory::class);
        $this->input = $this->createMock(InputModel::class);
        $this->answers = new Answers($this->printer, $this->inputFactory);
    }

    public function testGetInputYesOrNo(): void
    {
        $this->input->method('read')->willReturn('y');
        $this->inputFactory->method('create')->willReturn(
            $this->input
        );
        $this->assertTrue($this->answers->getInputYesOrNo('test'));
    }

    public function testGetInputString(): void
    {
        $this->input->method('read')->willReturn('test');
        $this->inputFactory->method('create')->willReturn(
            $this->input
        );
        $this->assertEquals(
            'test',
            $this->answers->getInputString('test')
        );
    }
    public function testGetInputStringWithDefault(): void
    {
        $this->input->method('read')->willReturn(
            '',
            'test'
        );
        $this->inputFactory->method('create')->willReturn(
            $this->input
        );
        $this->assertEquals(
            'test',
            $this->answers->getInputString(
                'test',
                'test',
                'test'
            )
        );
    }
}