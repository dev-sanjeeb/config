<?php

namespace SR\Config\Parsers\Types;

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

use SR\Config\Parsers\Parser;
use SR\Config\Parsers\Exceptions\InvalidContentException;

/**
 * Class Json
 *
 * @package SR\Config
 */
class Json implements Parser
{
    /**
     * Convert Json string to array
     *
     * @param string $content
     * @return array
     * 
     * @throws InvalidContentException
     */
    public function decode(string $content): array 
    {
        $arr = json_decode($content, true); 
      
        if (is_null($arr)) {
            throw new InvalidContentException();
        }

        return $arr;
    }
}
