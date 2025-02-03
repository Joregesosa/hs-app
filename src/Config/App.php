<?php

namespace App\Config;
use Dotenv\Dotenv;

class App
{
    private $secretKey; 
    public static function initialize()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }

    public function __construct()
    {
        $this->secretKey = $_ENV['SECRET_KEY'];
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

}