<?php

namespace SCHOENBECK\Router\Request;

class ElementEnvironment extends AbstractElement
{
    public function __construct()
    {
        $this->assignSettings($_ENV);
    }
}