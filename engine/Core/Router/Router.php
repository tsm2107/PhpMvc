<?php

namespace Engine\Core\Router;
class Router
{
    private $routes = [];
    private $host;
    private $dispatcher;

    /**
     * Router constructor.
     * @param $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * @param $key
     * @param $pattern
     * @param $controller
     * @param string $method
     */

    public function add($key, $pattern, $controller, $method = 'GET')
    {
        $this->routes[$key] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $method
        ];
    }

    /**
     * @param $method
     * @param $uri
     * @return DispathedRoute
     */
    public function dispatch($method, $uri)
    {
        return $this->getDispather()->dispatch($method, $uri);
    }
    public function redirect($url){
        return "<meta http-equiv='refresh' content='0;{$url}'>";
    }

    /**
     * @return UrlDispather
     */
    public function getDispather()
    {
        if ($this->dispatcher == null) {
            $this->dispatcher = new UrlDispather();
            foreach ($this->routes as $rote) {
                $this->dispatcher->register($rote['method'], $rote['pattern'], $rote['controller']);
            }
        }
        return $this->dispatcher;
    }

}