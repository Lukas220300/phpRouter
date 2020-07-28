<?php

namespace SCHOENBECK\Router;

class Router
{
    protected $request;
    protected $pathToControllers;
    protected $routes;

    /**
     * @param AbstractRequest $request
     * @param String $pathToControllers
     */
    public function __construct(AbstractRequest $request, String $pathToControllers = "controller/") 
    {
        $this->request = $request;
        $this->pathToControllers = $pathToControllers;
        if(isset($GLOBALS['SWS']['PHP_ROUTER']['CONTROLLER_PATH'])) {
            $this->pathToControllers = $GLOBALS['SWS']['PHP_ROUTER']['CONTROLLER_PATH'];
        }
        $this->routes = array();
    }

    /**
     * Add a new Route.
     * The controllerAndAction string has to be in a specific format:
     * 
     * <<controllerClassName>>::<<ActionMethodName>>
     * 
     * E.g.:
     * IndexController::indexAction
     * 
     * @param string $route The Route
     * @param string $controllerAndAction The controller and the action method in it.
     */
    public function addRoute(string $route, string $controllerAndAction)
    {
        $formattedRoute = $this->formatRoute($route);
        $this->routes[$formattedRoute] = $controllerAndAction;
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
        $controllerAndActionName = $this->routes[$route];
        
        if(null === $controllerAndActionName) {
            http_response_code(404);
            return null;
        }

        return call_user_func($controllerAndActionName);
    }

}