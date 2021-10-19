<?php

namespace SR\Config\Helpers;

/**
 * FileHelper
 *
 * @package   SR\Config
 *
 * @author    Sanjeeb Rao
 * @copyright 2021 dev-sanjeeb
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/dev-sanjeeb/config
 */

trait FileHelper {

    /**
     * Get contents from multiple or single file
     *
     * @param array|string $files
     * @return array
     * 
     * @throws InvalidArgumentException
     */
    protected function getFileData($files) :array 
    {
        $fileData = [];

        switch (gettype($files)) {
            case "array":
                foreach($files as $file) {
                    $fileData[] = $this->getFileContents($file); 
                }

                break;
            case "string":
                $fileData[] = $this->getFileContents($files);
                 
                break;
            default:
                throw new \InvalidArgumentException('$files must be a string or an array.');
        }

        return  $fileData;
    }

    /**
     * Get contents from single file
     *
     * @param string $filename
     * @return array
     * 
     * @throws InvalidArgumentException
     */
    protected function getFileContents(string $filename) :array 
    {
        if (!file_exists($filename)) {
            throw new \InvalidArgumentException("invalid file path: $filename");
        }

        $content = file_get_contents($filename);

        return ['type' => $this->getFileExtension($filename), 'content' => $content];
    }  

    /**
     * Get file extension
     *
     * @param string $filename
     * @return string
     * 
     * @throws InvalidArgumentException
     */
    protected function getFileExtension(string $filename) :string 
    {
        $path_parts = pathinfo($filename);

        if (is_null($path_parts['extension'])) {
            throw new \InvalidArgumentException("invalid file extension: $filename");
        }

        return $path_parts['extension'];
    }
}
