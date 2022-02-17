<?php
/**
 * Created by PhpStorm.
 * User: this
 * Date: 03.08.2018
 * Time: 15:18
 */

namespace Engine\Core\Router;


class DispathedRoute
{
    private $controller;
    private $parametrs;

    public function __construct($controller,$parametrs = [])
    {
        $this->controller = $controller;
        $this->parametrs = $parametrs;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getParametrs()
    {
        return $this->parametrs;
    }
}