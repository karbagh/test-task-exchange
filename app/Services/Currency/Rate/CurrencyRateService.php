<?php

namespace App\Services\Currency\Rate;

use Iterator;
use Generator;
use App\Clients\CBR\Currency\Rates\CBRClient;
use App\Collections\Currency\Rate\CurrencyRateCollection;
use App\Parsers\XML\Currency\Rate\CurrencyRateXMLParser;
use App\Repositories\Currency\CurrencyRepository;

class CurrencyRateService
{
    private readonly CBRClient $client;
    private readonly CurrencyRateXMLParser $parser;
    private readonly CurrencyRateCollection $collection;
    private readonly CurrencyRepository $repository;

    public function __construct(
    ) {
        $this->client = new CBRClient();
        $this->parser = new CurrencyRateXMLParser();
        $this->collection = new CurrencyRateCollection();
        $this->repository = new CurrencyRepository();
    }

    public function getList(): ?string
    {
       return $this->client->list();
    }

    public function parse(string $responseXML): Generator
    {
        $items = $this->parser->listCBR($responseXML);
        foreach ($items as $item) {
            yield $item;
        }
    }

    public function collect(Iterator $itemsIterator): CurrencyRateCollection
    {
        return $this->collection->setItems($itemsIterator);
    }

    public function saveToDB(CurrencyRateCollection $collection): void
    {
        $this->repository->insertCurrencies($collection->getSavingData());
        $this->repository->insertCurrencyValues($collection->getSavingValues($this->repository->pluckIds()));
    }
}
