<?php

namespace SCHOENBECK\Router\Request;

use Exception;
/**
 * @author Lukas Schoenbeck
 */
abstract class AbstractElement
{
    /**
     * Assign the given SettingsArray as class variables with Key as variable name 
     * and value as value to current class.
     * @param array $settingsArray
     */
    protected function assignSettings(array $settingsArray) {

        if(null === $settingsArray) {
            throw new Exception("Settings array for Request Element was not given.");
        }

        foreach($settingsArray as $key => $value)
        {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * Format the given string in CamelCase.
     * @param string $string
     */
    protected function toCamelCase(string $string)
    {
        $result = strtolower($string);
        preg_match_all('/_[a-z]/', $result, $matches);
        foreach($matches[0] as $match)
        {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }
}