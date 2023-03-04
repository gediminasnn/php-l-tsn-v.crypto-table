<?php

namespace App\Interfaces;

use App\Dto\CryptoCurrencyDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ICryptoCurrencyRepository
{
    public function findByTermOrAllAndPaginate(string $searchTerm, int $recordsPerPage): LengthAwarePaginator;
    public function updateOrCreate(CryptoCurrencyDto $cryptoCurrencyDto): bool;
}
