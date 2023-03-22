<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Exceptions;

/**
 * 100 -> Name of folder must not be empty.
 * 101 -> The target folder is invalid.
 * 102 -> The folder already exists.
 * 103 -> An undetermined error occurred during the folder creation:.
 * 104 -> An undetermined error occurred during the folder suppression:.
 */
class FolderException extends ExceptionAbstract
{

}
