<?php

namespace SCHOENBECK\Router\Request;

/** */
class ElementServer extends AbstractElement
{
    /** */
    public function __construct()
    {
        $this->assignSettings($_SERVER);
    }
}