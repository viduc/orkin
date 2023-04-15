<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Printer;

use Minicli\Output\OutputHandler;
use Viduc\Orkin\Factory\InputFactory;

class Answers
{
    public function __construct(
        public OutputHandler $printer,
        private InputFactory $inputFactory
    ){
    }

    /**
     * @param string $identifier
     * @param string $display
     *
     * @return bool
     */
    final public function getInputYesOrNo(
        string $identifier,
        string $display = ''
    ): bool {
        $this->printer->display($display);
        $value = null;
        while ($value === null) {
            $input = $this->inputFactory->create(
                ['message' => $identifier.'? (Y/n) > ']
            );
            $value = $input->read();
            $value = $value === '' ? 'y' : $value;
            $value = in_array(strtolower($value), ['y', 'n']) ?
                strtolower($value) === 'y' : null;
        }

        return $value == 'y';
    }

    /**
     * @param string $identifier
     * @param string $display
     *
     * @return string
     */
    final public function getInputString(
        string $identifier,
        string $display = '',
        string $default = ''
    ): string {
        if ('' !== $display) {
            $this->printer->display($display);
        }
        $value = '';
        while ('' === $value) {
            $input = $this->inputFactory->create(
                ['message' => $identifier.' > ']
            );
            $value = $input->read();
            if ('' === $value && '' !== $default) {
                $value = $default;
            }
        }

        return $value;
    }
}