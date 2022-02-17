<?php
/*
 * Created by PhpStorm.
 * User: this
 * Date: 08.01.2020
 * Time: 14:22
 */

namespace Cms\Controller;

use Engine\Controller;
use Twig\TwigFunction;

class CrmController extends Controller
{
    public $versions;
    public $function;

    public function __construct($di)
    {
        parent::__construct($di);
        $this->versions = new TwigFunction('versionfile', function ($a) {
            return filemtime(__DIR__ . '/../../' . $a);
        });
        $this->function = new TwigFunction('assets', function ($a) {
            $array_self = explode('/', $_SERVER['REQUEST_URI']);
            array_splice($array_self, 0, 2);
            $patch = '';
            foreach ($array_self as $tmpself) {
                $patch .= "../";
            }
            return $patch . $a;
        });
        $this->di->get('templates')->addFunction($this->function);
        $this->di->get('templates')->addFunction($this->versions);
    }
    public function index1()
    {
        echo $this->di->get('templates')->render('index.twig', [
            'q' => 1,
        ]);
    }
    public function index2($id)
    {
        echo $this->di->get('templates')->render('index.twig', [
            'q' => $id,
        ]);
    }
    public function page404(){
        echo 'Нет такой страницы';
    }

}