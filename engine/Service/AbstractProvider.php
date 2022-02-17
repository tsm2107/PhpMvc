<?php
namespace Engine\Service;
/**
 * Created by PhpStorm.
 * User: this
 * Date: 03.08.2018
 * Time: 13:24
 */
abstract class AbstractProvider
{
    protected $di;

    public function __construct(\Engine\DI\DI $di)
    {
        $this->di = $di;
    }
    abstract function init();
}