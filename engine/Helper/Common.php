<?php

namespace Engine\Helper;
class Common
{
    /**
     * @return bool
     */
     function isPost() // or php8.0 /*public state*/
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    function getMethod() // or php8.0 /*public state*/
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool|string
     */
    function getPatchUrl()// or php8.0 /*public state*/
    {
        $pathUrl = $_SERVER['REQUEST_URI'];

        if ($position = strpos($pathUrl, '?')) {

            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }
}
