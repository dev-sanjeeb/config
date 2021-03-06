<?php

namespace SR\Config\Parsers;

/**
 * Parser
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */

use SR\Config\Parsers\Exceptions\InvalidContentException;

/**
 * Interface Parser
 *
 * @package SR\Config
 */
interface Parser
{
   /**
    * Convert string to array
    *
    * @param string $content
    * @return array
    *
    * @throws InvalidContentException
    */
    public function decode(string $content): array;
}
