<?php

namespace SCHOENBECK\Router;

use SCHOENBECK\Router\Request\ElementEnvironment;
use SCHOENBECK\Router\Request\ElementServer;

class GlobalsRequest extends AbstractRequest
{
    /**
     * Stores all settings from server
     * @var ElementServer $server
     */
    protected $server;

    /**
     * Stores all settings from environment
     * @var ElementEnvironment $environment
     */
    protected $environment;

    public function __construct()
    {
        $this->server = new ElementServer();
        $this->environment = new ElementEnvironment();
    }

    /**
     * Returns the ElementSever object;
     * @return ElementServer
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Returns the ElementEnvironment object
     * @return ElementEnvironment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
}
