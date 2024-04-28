<?php

namespace App\Factories\Services;

use App\Services\Currency\Rate\CurrencyRateService;

class ServiceFactory
{
    /**
     * @return CurrencyRateService
     */
    public static function makeCurrencyRateService(): CurrencyRateService
    {
        return new CurrencyRateService();
    }
}
