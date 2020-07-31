<?php


namespace App\Service\Spotify;


use Symfony\Component\HttpClient\HttpClient;

class Base
{
    public $basicBuffer;
    public $client;

    /**
     * Base constructor.
     */
    public function __construct()
    {
        $this->basicBuffer = base64_encode($_ENV['CLIENT_ID'] . ':' . $_ENV['CLIENT_SECRET']);
        $this->client = HttpClient::create();
    }
}