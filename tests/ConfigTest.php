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
}
