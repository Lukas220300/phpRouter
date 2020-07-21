<?php

namespace SCHOENBECK\Router;

class Router
{
    protected $request;
    protected $pathToControllers;
    protected $controllerSuffix = "Controller";
    protected $routes;

    /**
     * @param AbstractRequest $request
     */
    public function __construct(AbstractRequest $request) 
    {
        $this->request = $request;
        $this->pathToControllers = "controller/"; //TODO: get out of Globals settings
        $this->routes = array();
    }

    /**
     * Add a new Route.
     * The Controller name have to be without the suffix Controller.
     * E.g.: 
     * File name -> IndexController.php
     * Class name -> IndexController
     * controller name -> Index
     * 
     * => Suffix = Controller
     * 
     * @param string $route The Route
     * @param string $controller The ControllerName without the Suffix.
     */
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

    /**
     * Resolve the Route from the given request.
     * If route is not defined the will return with response code 404.
     * 
     * @return string result of defined controller of the route;
     */
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