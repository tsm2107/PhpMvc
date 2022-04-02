<?php
namespace Engine\Service\JWT;

use Engine\Service\AbstractProvider;
use Engine\Core\Auth\JwtAuth;

class Provider extends AbstractProvider
{
    public $serviceName = 'JWT';

    public function init()
    {
        $jwt = new JwtAuth();
        $this->di->set($this->serviceName, $jwt);
    }
}