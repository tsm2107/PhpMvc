<?php
namespace Engine\Service\Template;
use Engine\Service\AbstractProvider;

use Twig_Loader_Filesystem;
use Twig_Environment;

class Provider extends AbstractProvider
{

    public $serviceName = 'templates';
    public $Twig;
    public $Template;
    function init()
    {
        $this->Twig = new Twig_Loader_Filesystem('template');
        $this->Template = new Twig_Environment($this->Twig);
        $this->di->set($this->serviceName,$this->Template);
    }
}