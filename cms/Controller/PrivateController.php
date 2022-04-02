<?php
namespace Cms\Controller;
use Engine\Controller;
use Twig\TwigFunction;

class PublicController extends Controller
{
    public $versions;
    public $function;
    private $autUser;

    public function __construct($di)
    {
        parent::__construct($di);
        $this->autUser = $this->di->get('JWT')->auth_user(); //Проверка куке пользователя на авторизацию
    }

    public function auth()
    {
        var_dump($this->di->get('JWT')->autologin(['id' => 123]));
    }

    public function check()
    {
        if ($this->autUser['status']) {
            var_dump($this->autUser);
            echo 'Авторизован!';
        }else{
            echo 'НЕ Авторизован!';
        }
    }

}