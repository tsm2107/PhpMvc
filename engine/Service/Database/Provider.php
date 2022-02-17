<?php

namespace Engine\Service\Database;

use Engine\Service\AbstractProvider;
use Engine\Core\Database\Conection;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'db';

    public function init()
    {
        $db = new Conection();
        $this->di->set($this->serviceName,$db);
        // TODO: Implement init() method.
    }
}