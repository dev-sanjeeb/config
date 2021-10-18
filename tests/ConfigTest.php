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
}