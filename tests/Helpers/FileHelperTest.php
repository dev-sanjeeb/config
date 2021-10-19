<?php

namespace SR\Config\Tests\Parsers\Types;

/**
 * FileHelperTest
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */
use SR\Config\Helpers\FileHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class FileHelperTest
 *
 * @package SR\Config\Tests
 */
class FileHelperTest extends TestCase 
{
    use FileHelper;

    /**
	 * Checks if get file data will throws exception with invalid data type
	 */
    public function test_get_file_data_with_invalid_argument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$files must be a string or an array.');

        $data = $this->getFileData(1);
    }

    /**
	 * Checks if get file data will works with string data type
	 */
    public function test_get_file_data_with_valid_string_argument()
    {
        $data = $this->getFileData(__DIR__.'/files/test.json');
        $this->assertEquals(
            [['type' => 'json', 'content' => '{"a":1,"b":2,"c":3,"d":4,"e":5}']], 
            $data
        );
    }

    /**
	 * Checks if get file data will works with array data type
	 */
    public function test_get_file_contents_with_valid_array_argument()
    {
        $data = $this->getFileData([__DIR__.'/files/test.json', __DIR__.'/files/test.json']);
        $this->assertEquals(
            [
                ['type' => 'json', 'content' => '{"a":1,"b":2,"c":3,"d":4,"e":5}'],
                ['type' => 'json', 'content' => '{"a":1,"b":2,"c":3,"d":4,"e":5}'],
            ], 
            $data
        );
    }

    /**
	 * Checks if get file contents will works with string data type
	 */
    public function test_get_file_contents_will_return_valid_array()
    {
        $data = $this->getFileContents(__DIR__.'/files/test.json');
        $this->assertEquals(
            ['type' => 'json', 'content' => '{"a":1,"b":2,"c":3,"d":4,"e":5}'], 
            $data
        );
    }

    /**
	 * Checks if get file contents will throws exception with invalid files path
	 */
    public function test_get_file_contents_will_return_exception_with_invalid_file()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('invalid file path: xyz');
        $this->getFileContents('xyz');
    }

    /**
	 * Checks if get file contents will works with string data type
	 */
    public function test_get_file_extension_will_return_valid_array()
    {
        $data = $this->getFileExtension(__DIR__.'/files/test.json');
        $this->assertEquals(
            'json', 
            $data
        );
    }

    /**
	 * Checks if get file contents will works with string data type
	 */
    public function test_get_file_1_extension_will_return_valid_array()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('invalid file extension: abc');

        $data = $this->getFileExtension('abc');
    }
}
