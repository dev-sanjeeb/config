<?php

namespace SR\Config;

/**
 * Config
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */

use SR\Config\Parsers\ParserFactory;
use SR\Config\Helpers\FileHelper;

class Config implements ConfigInterface
{
    use FileHelper;

    /**
     * Collection of nested key attributes and values.
     *
     * @var array
     */
    protected $configTree = [];
    
    /**
     * construct
     *
     * @param array|null $files
     */
    public function __construct(?array $files = [])
    {
        $this->loadFiles($files);
    }

    /**
     * Returns the value for given key. 
     * 
     * Returns default if key is not found.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function get(?string $key = null, $default = null)
    {
        $tempConfig = $this->configTree;

        if (!is_null($key)) {
            foreach (explode('.', $key) as $k) {
                if (!isset($tempConfig[$k])) {
                    return $default;
                }

                $tempConfig = $tempConfig[$k];
            }
        }    

        return $tempConfig;
    }

    /**
     * Sets the value for given key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, $value) :bool 
    {
        $configTree = &$this->configTree;

        foreach (explode('.', $key) as $k) {
            if (!isset($configTree[$k])) {
                $configTree[$k] = null;
            }

            $configTree = &$configTree[$k]; 
        }
    
        $configTree = $value;
        
        return true;
    }

    /**
     * Unsets the value for given key. 
     *
     * @param string $key
     * @return void
     */
    public function unset(string $key) :bool 
    {
        $configTree = &$this->configTree;

        foreach (explode('.', $key) as $k) {
            $configTree = &$configTree[$k];
        }

        $configTree = null;

        return true;
    }

    /**
     * Whether a key exists.
     *
     * @param string $key
     * @return boolean true on success or false on failure.
     */
    public function has(string $key) :bool 
    {
        $configTree = $this->configTree;

        foreach (explode('.', $key) as $k) {
            if (!isset($configTree[$k])) { 
                return false;
            }
        }

        return true;
    }

    /**
     * Reset the config tree
     *
     * @return boolean
     */
    public function reset() :bool 
    {
        $this->configTree = [];

        return true;
    }

    /**
     * Merge given tree with config tree
     *
     * @param array $tree
     * @return boolean
     */
    public function merge(array $tree) :bool 
    {
        $this->configTree = array_replace_recursive($this->configTree, $tree);
        return true;
    }

    /**
     * Load raw text with parser type
     *
     * @param array $rawContents
     * @return void
     */
    public function loadRawText(array $rawContents) 
    {
        foreach($rawContents as $rawContent) {
            $tree = $this->parseData($rawContent['content'] ?? '', $rawContent['type'] ?? '');
            $this->merge($tree);
        }
    }

    /**
     * Load raw text with parser type
     *
     * @param array|string $files
     * @return void
     */
    public function loadFiles($files) 
    {
        $fileData = $this->getFileData($files);
        $this->loadRawText($fileData);
    }

   /**
    * Parse content using give parser type
    *
    * @param string $content
    * @param string $parserType
    * @return array
    */
    protected function parseData(string $content, string $parserType) :array 
    {
        $parserObject = ParserFactory::getParser($parserType);

        return $parserObject->decode($content);
    }
}
