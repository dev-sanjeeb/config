<?php

namespace SR\Config\Tests\Parsers\Types;

/**
 * JsonTest
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */

use SR\Config\Parsers\Types\Json;
use SR\Config\Parsers\Exceptions\InvalidContentException;
use PHPUnit\Framework\TestCase;

/**
 * Class JsonTest
 *
 * @package SR\Config\Tests
 */
class JsonTest extends TestCase 
{
    /**
	 * Checks if decode would works with valid Json
	 */
    public function test_it_can_decode_json()
    {
        $json = new Json();
    
        $this->assertEquals(
            [
                "a" => 1,
                "b" => 2,
                "c" => 3,
                "d" => 4,
                "e" => 5,
            ], 
            $json->decode('{"a":1,"b":2,"c":3,"d":4,"e":5}')
        );
    }

    /**
	 * Checks if decode would throw exception with invalid Json
	 */
    public function test_it_will_throw_expection_with_invalid_content()
    {
        $json = new Json();
        $this->expectException(InvalidContentException::class);
        $json->decode('abc');
    }
}
