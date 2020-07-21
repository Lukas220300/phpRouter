<?php

namespace SCHOENBECK\Router\Request;

use Exception;

abstract class AbstractElement
{
    protected function assignSettings(array $settingsArray) {

        if(null === $settingsArray) {
            throw new Exception("Settings array for Request Element was not given.");
        }

        foreach($settingsArray as $key => $value)
        {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    protected function toCamelCase($string)
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