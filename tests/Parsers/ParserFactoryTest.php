<?php

namespace SR\Config\Tests\Parsers;

/**
 * ParserFactoryTest
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */

use SR\Config\Parsers\ParserFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class ParserFactoryTest
 *
 * @package SR\Config\Tests
 */
class ParserFactoryTest extends TestCase 
{
    /**
	 * Checks if parser factory unable to give valid parser object
	 */
    public function test_parser_factory()
    {
        $json = ParserFactory::getParser('json');
    
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
	 * Checks if parser factory unable to give valid parser object
	 */
    public function test_parser_factory_with_invalid_parser()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('json1 type is not supported.');
        $json = ParserFactory::getParser('json1');
    }
}
