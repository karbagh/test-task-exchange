<?php

namespace App\Parsers\XML\Currency\Rate;

class CurrencyRateXMLParser
{
    public function listCBR(string $content)
    {
        $simpleXMLElement = simplexml_load_string($content);
        return $simpleXMLElement->Valute;
    }
}
