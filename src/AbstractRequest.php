<?php

namespace SCHOENBECK\Router;

/** */
abstract class AbstractRequest
{
    abstract public function getServer();
    abstract public function getEnvironment();
}