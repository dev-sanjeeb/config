<?php

namespace SR\Config\Tests;

/**
 * ConfigTest
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */

use SR\Config\Config;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigTest
 *
 * @package SR\Config\Tests
 */
class ConfigTest extends TestCase 
{
    /**
	 * Checks if set and get would works on valid key
	 */
    public function test_it_can_set_and_retrieve_an_item()
    {
        $config = new Config();

        $this->assertTrue($config->set('name', 'sanjeeb'));
        $this->assertEquals('sanjeeb', $config->get('name'));
    }

    /**
	 * Checks if get would return default value on invalid key
	 */
    public function test_it_can_retrieve_default_item_if_no_key_found()
    {
        $config = new Config();
        $this->assertEquals('sanjeeb', $config->get('name', 'sanjeeb'));
    }

    /**
	 * Checks if get would return all data if no parameter is passed
	 */
    public function test_it_can_retrieve_all()
    {
        $config = new Config();
        $config->set('name', 'sanjeeb');
        $this->assertEquals(['name' => 'sanjeeb'], $config->get());
    }

    /**
	 * Checks if it would reset all data
	 */
    public function test_it_can_reset_all_data()
    {
        $config = new Config();
        $config->set('name', 'sanjeeb');
        $this->assertTrue($config->reset());
        $this->assertEquals([], $config->get());
    }

    /**
	 * Checks if it would unset given key
	 */
    public function test_it_unset_given_key()
    {
        $config = new Config();
        $config->set('emp.name', 'sanjeeb');
        $this->assertTrue($config->unset('emp.name'));
        $this->assertEquals(['emp' => ['name' => null]], $config->get());
    }

    /**
	 * Checks if has method can check whether a key exists or not
	 */
    public function test_it_can_check_whether_a_key_exists()
    {
        $config = new Config();
        $this->assertEquals(false, $config->has('name'));
        $config->set('name', 'sanjeeb');
        $this->assertEquals(true, $config->has('name'));
    }

    /**
	 * Checks if merge would merge data with config tree 
	 */
    public function test_it_can_merge_data()
    {
        $config = new Config();
        $config->set('emp.name', 'sanjeeb');
        $this->assertEquals(true, $config->merge(['emp' => ['age' => 20]]));
        $this->assertEquals(
            ['emp' => ['name' => 'sanjeeb', 'age' => 20]], 
            $config->get()
        );
    }

    /**
	 * Checks if merge would merge data with config tree 
	 */
    public function test_it_can_parse_data()
    {
        $class = new \ReflectionClass('SR\Config\Config');
        $method = $class->getMethod('parseData');
        $method->setAccessible(true);

        $config = new Config();

        $this->assertEquals(
            [
                "a" => 1,
                "b" => 2,
                "c" => 3,
                "d" => 4,
                "e" => 5,
            ], 
            $method->invokeArgs(
                $config,
                [
                    '{"a":1,"b":2,"c":3,"d":4,"e":5}',
                    'json'
                ]
            )
        );
    }

    /**
	 * Checks if merge would merge data with config tree 
	 */
    public function test_it_can_load_raw_text_with_given_format()
    {
        $config = new Config();
        $config->loadRawText(
            [[
                'content' => '{"a":1,"b":2,"c":3,"d":4,"e":5}',
                'type' => 'json'
            ]]
        );
        
        $this->assertEquals(
            [
                "a" => 1,
                "b" => 2,
                "c" => 3,
                "d" => 4,
                "e" => 5,
            ], 
            $config->get()
        );
    }
}
