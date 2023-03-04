<?php

namespace App\Dto;

class CryptoCurrencyDto
{
    private string $symbol;
    private string $name;
    private float $price;
    private float $market_cap;
    private float $percent_change_24h;

    public function __construct(string $symbol, string $name, float $price, float $market_cap, float $percent_change_24h)
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->price = $price;
        $this->market_cap = $market_cap;
        $this->percent_change_24h = $percent_change_24h;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getMarketCap(): float
    {
        return $this->market_cap;
    }

    public function getPercentChange24h(): float
    {
        return $this->percent_change_24h;
    }
}
