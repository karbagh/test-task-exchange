<?php

namespace App\Clients\CBR;

use GuzzleHttp\Client as CBRClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class Client
{
    protected CBRClient $client;

    public function __construct()
    {
        $this->client = new CBRClient();
    }

    /**
     * @throws GuzzleException
     */
    public function request(string $method, array $options = []): ResponseInterface
    {
        return $this->client->request($method, config('cbr.host'), $options);
    }

    public abstract function list(): ?string;
}
