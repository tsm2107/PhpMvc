<?php

namespace Engine\Core\Auth;
use Firebase\JWT\JWT;


class JwtAuth extends JWT
{
    public $access_token;
    public $refresh_token;
    public $expiration_token;
    public $refresh_token_expiration;


    public function __construct()
    {
        $this->access_token = '1BveFBzAxiJskiYukD5uYuph5ynULNCgS9';
        $this->expiration_seconds = 60 * 60 * 30;
    }
    public function auth_user()
    {
        $token = $_COOKIE['access_token'];
        try {
            $user_refresh = parent::decode($token, $this->access_token, array('HS256'));
            return array_merge(['status'=>true],(array)$user_refresh);
        } catch (\Exception $e) {
            return ['status'=>false];
        }
    }
    public function autologin($userData = [])
    {
        try {
            $access_token = parent::encode(array(
                'iat' => $_SERVER['REQUEST_TIME'],
                'exp' => $_SERVER['REQUEST_TIME'] + $this->expiration_seconds,
                'data' => $userData
            ), $this->access_token);
            setcookie('access_token', $access_token, time() + 60 * 60 * 24 * 30, '/');
            return (array) $access_token;
        }catch (\Exception $e) {
            return [];
        }
    }
}
