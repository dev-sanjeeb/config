<?php

namespace SR\Config;

/**
 * ConfigInterface
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */

interface ConfigInterface
{
    /**
     * Returns the value for given key. 
     * 
     * Returns default if key is not found.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function get(?string $key = null, $default = null);

    /**
     * Sets the value for given key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, $value) :bool;

    /**
     * Unsets the value for given key. 
     *
     * @param string $key
     * @return void
     */
    public function unset(string $key) :bool;

    /**
     * Whether a key exists.
     *
     * @param string $key
     * @return boolean true on success or false on failure.
     */
    public function has(string $key) :bool;

    /**
     * Reset the config tree
     *
     * @return boolean
     */
    public function reset() :bool;

    /**
     * Merge given tree with config tree
     *
     * @param array $tree
     * @return boolean
     */
    public function merge(array $tree) :bool;

    /**
     * Load raw text with parser type
     *
     * @param array $rawContents
     * @return void
     */
    public function loadRawText(array $rawContents);
}
