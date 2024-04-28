<?php

namespace App\Entities\Currency\Rate;

use Illuminate\Support\Collection;

class CurrencyRateEntity
{
    /**
     * @var string
     */
    private string $numCode;
    /**
     * @var string
     */
    private string $charCode;
    /**
     * @var int
     */
    private int $nominal;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var float
     */
    private float $value;
    /**
     * @var float
     */
    private float $vunitRate;

    /**
     * @return string
     */
    public function getNumCode(): string
    {
        return $this->numCode;
    }

    /**
     * @param string $numCode
     * @return void
     */
    public function setNumCode(string $numCode): void
    {
        $this->numCode = $numCode;
    }

    /**
     * @return string
     */
    public function getCharCode(): string
    {
        return $this->charCode;
    }

    /**
     * @param string $charCode
     * @return void
     */
    public function setCharCode(string $charCode): void
    {
        $this->charCode = $charCode;
    }

    /**
     * @return int
     */
    public function getNominal(): int
    {
        return $this->nominal;
    }

    /**
     * @param int $nominal
     * @return void
     */
    public function setNominal(int $nominal): void
    {
        $this->nominal = $nominal;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return void
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getVunitRate(): float
    {
        return $this->vunitRate;
    }

    /**
     * @param float $vunitRate
     * @return void
     */
    public function setVunitRate(float $vunitRate): void
    {
        $this->vunitRate = $vunitRate;
    }

    public function toSaveData(): array
    {
        return [
            'num_code' => $this->getNumCode(),
            'char_code' => $this->getCharCode(),
            'nominal' => $this->getNominal(),
            'name' => $this->getName(),
        ];
    }

    public function toSaveDataValues(Collection $currencies): array
    {
        return [
            'currency_id' => $currencies->get($this->getNumCode()),
            'value' => $this->getValue(),
            'vunit_rate' => $this->getVunitRate(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
