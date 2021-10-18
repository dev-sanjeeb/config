<?php

namespace SR\Config\Parsers;

class ParserFactory
{
    /**
     * private construct to stop object creation
     */
    private function __construct() {
    }

    /**
     * private clone to stop object creation
     *
     * @return void
     */
    private function __clone() {
    }
    
    /**
     * Factory method to Parser object of given type
     *
     * @param string $type
     * @return Parser
     */
    public static function getParser(string $type): Parser {
        $parserClass = __NAMESPACE__ . '\\Types\\' .  ucwords(trim($type));
        return new $parserClass();
    }
}