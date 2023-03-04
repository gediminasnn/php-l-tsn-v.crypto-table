<?php

namespace App\Repositories;

use App\Dto\CryptoCurrencyDto;
use App\Models\CryptoCurrency;
use App\Interfaces\ICryptoCurrencyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CryptoCurrencyRepository implements ICryptoCurrencyRepository
{
    public function findByTermOrAllAndPaginate(string $searchTerm, int $recordsPerPage): LengthAwarePaginator
    {
        return CryptoCurrency::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('symbol', 'LIKE', "%{$searchTerm}%")
            ->orderBy('market_cap', 'DESC')
            ->paginate($recordsPerPage);
    }

    public function updateOrCreate(CryptoCurrencyDto $cryptoCurrency): bool
    {
        $crypto = CryptoCurrency::updateOrCreate(
            ['symbol' => $cryptoCurrency->getSymbol()],
            [
                'name' => $cryptoCurrency->getName(),
                'price' => $cryptoCurrency->getPrice(),
                'market_cap' => $cryptoCurrency->getMarketCap(),
                'percent_change_24h' => $cryptoCurrency->getPercentChange24h()
            ]
        );

        return $crypto->save();
    }
}
