<?php

namespace SR\Config\Parsers;

class ParserFactory
{
    /**
     * Collection of custom parser.
     *
     * @var array
     */
    protected static $parser = [];

    /**
     * private construct to stop object creation
     */
    private function __construct() 
    {
    }

    /**
     * private clone to stop object creation
     *
     * @return void
     */
    private function __clone() 
    {
    }
    
    /**
     * Factory method to Parser object of given type
     *
     * @param string $type
     * @return Parser
     * 
     * @throws InvalidArgumentException
     */
    public static function getParser(string $type): Parser 
    {
        if (isset(static::$parser[$type])) {
            return static::$parser[$type];
        }

        $parserClass = __NAMESPACE__ . '\\Types\\' .  ucwords(trim($type));

        if (!class_exists($parserClass)) {
            throw new \InvalidArgumentException("$type type is not supported.");
        }

        return new $parserClass();
    }

    /**
     * Register custom parser
     *
     * @param string $type
     * @param Parser $parser
     * @return void
     */
    public static function register(string $type, Parser $parser)
    {
        static::$parser[$type] = $parser;
    }

    /**
     * Unregister custom parser
     *
     * @param string $type
     * @return boolean
     */
    public static function unregister(string $type): bool 
    {
        unset(static::$parser[$type]);
        
        return true;
    }
}
