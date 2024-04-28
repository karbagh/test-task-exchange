<?php

namespace App\Clients\CBR\Currency\Rates;

use App\Clients\CBR\Client;

class CBRClient extends Client
{

    public function list(): string
    {
        $responseXml = $this->request('GET');
        return $responseXml->getBody()->getContents();
    }
}
