<?php

namespace Engine\Core\Router;


class UrlDispather
{
    /**
     * @var array
     */
    private $methods = [
        'GET', 'POST'
    ];
    /**
     * @var array
     */
    private $routes = [
        'GET' => [],
        'POST' => [],

    ];
    /**
     * @var array
     */
    private $patterns = [
        'int' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];

    /**
     * @param $method
     * @return array|mixed
     */
    public function routes($method)
    {
        return isset($this->routes[$method]) ? $this->routes[$method] : [];

    }

    /**
     * @param $key
     * @param $pattern
     */
    public function addPatten($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
    }

    public function register($method, $pattern, $controller)
    {
        $convert = $this->convertPatern($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    private function convertPatern($pattern)
    {
        if (strpos($pattern, "(") === false) {
            return $pattern;
        }
        return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, 'replacePattern'], $pattern);
    }

    private function replacePattern($matches)
    {
        return '(?<'.$matches[1].'>'.strtr($matches[2],$this->patterns).')';
    }
    private function processParam($paramiters){
        foreach ($paramiters as $key=>$value){
            if(is_int($key)){
                unset($paramiters[$key]);
            }
        }
        return $paramiters;
    }
    /**
     * @param $method
     * @param $uri
     * @return DispathedRoute
     */
    public function dispatch($method, $uri)
    {
        $routes = $this->routes(strtoupper($method));

        if (array_key_exists($uri, $routes)) {
            return new DispathedRoute($routes[$uri]);
        }
        return $this->doDispatch($method, $uri);
    }

    private function doDispatch($method, $uri)
    {
        foreach ($this->routes($method) as $route => $controller) {

            $pattern = '#^' . $route . '$#s';
            if (preg_match($pattern, $uri, $paramiters)) {

                return new DispathedRoute($controller, $this->processParam($paramiters));
            }
        }
    }

}