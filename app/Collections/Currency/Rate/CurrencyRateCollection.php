<?php

namespace App\Collections\Currency\Rate;

use Closure;
use Iterator;
use Illuminate\Support\Collection;
use App\Entities\Currency\Rate\CurrencyRateEntity;

class CurrencyRateCollection
{
    private array $items;

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(Iterator $iterator): self
    {
        foreach ($iterator as $item) {
            $currencyRateEntity = new CurrencyRateEntity();
            $currencyRateEntity->setNumCode($item->NumCode->__toString());
            $currencyRateEntity->setCharCode($item->CharCode->__toString());
            $currencyRateEntity->setNominal((int)$item->Nominal->__toString());
            $currencyRateEntity->setName($item->Name->__toString());
            $currencyRateEntity->setValue((float)str_replace(',', '.', $item->Value->__toString()));
            $currencyRateEntity->setVunitRate((float)str_replace(',', '.', $item->VunitRate->__toString()));
            $this->items[] = $currencyRateEntity;
        }

        return $this;
    }

    public function filter(Closure $callback): array
    {
        return array_filter($this->items, $callback);
    }

    public function getByNumCode(string $numCode): array
    {
        return $this->filter(fn (CurrencyRateEntity $entity) => $entity->getNumCode() == $numCode);
    }

    public function getSavingData(): array
    {
        return array_map(fn(CurrencyRateEntity $entity) => $entity->toSaveData(), $this->getItems());
    }

    public function getSavingValues(Collection $currencies): array
    {
        return array_map(fn(CurrencyRateEntity $entity) => $entity->toSaveDataValues($currencies), $this->getItems());
    }
}
