<?php

namespace SCHOENBECK\Router;

use SCHOENBECK\Router\Request\ElementEnvironment;
use SCHOENBECK\Router\Request\ElementServer;

class GlobalsRequest extends AbstractRequest
{
    protected $server;
    protected $environment;

    public function __construct()
    {
        $this->server = new ElementServer();
        $this->environment = new ElementEnvironment();
    }

    public function getServer()
    {
        return $this->server;
    }

    public function getEnvironment()
    {
        return $this->environment;
    }
}
