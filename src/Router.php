<?php

namespace SCHOENBECK\Router;

class Router
{
    protected $request;
    protected $pathToControllers;
    protected $controllerSuffix = "Controller";
    protected $routes;

    public function __construct(AbstractRequest $request) 
    {
        $this->request = $request;
        $this->pathToControllers = "controller/"; //TODO: get out of Globals settings
        $this->routes = array();
    }

    public function addRoute(string $route, string $controller)
    {
        $formattedRoute = $this->formatRoute($route);
        $this->routes[$formattedRoute] = $controller;
    }

    /**
    * Removes trailing forward slashes from the right of the route.
    * @param route (string)
    */
    protected function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ('' === $result)
        {
            return '/';
        }
        return $result;
    }

    public function resolveRoute()
    {
        $route = $this->formatRoute($this->request->getServer()->requestUri);
        $controllerName = $this->routes[$route];
        
        if(null === $controllerName) {
            http_response_code(404);
            return null;
        }

        $controllerClassName = $controllerName . $this->controllerSuffix;
        $controllerClass = new $controllerClassName();

        return $controllerClass->render();
    }

}