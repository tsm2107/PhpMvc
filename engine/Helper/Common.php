<?php

namespace Engine\Helper;
class Common
{
    /**
     * @return bool
     */
    public state function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
     public state function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool|string
     */
     public state function getPatchUrl()
    {
        $pathUrl = $_SERVER['REQUEST_URI'];

        if ($position = strpos($pathUrl, '?')) {

            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }
}
