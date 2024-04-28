<?php

namespace App\Services\Currency;

use App\Repositories\Currency\CurrencyRepository;
use Illuminate\Database\Eloquent\Collection;

class CurrencyService
{

    public function __construct(private readonly CurrencyRepository $repository)
    {
    }

    public function listFromDatabase(?string $date): Collection
    {
        return $this->repository->getListWithCurrentRate($date);
    }
}
