<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'price',
        'market_cap',
        'percent_change_24h'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'market_cap' => 'integer',
        'percent_change_24h' => 'decimal:2'
    ];
}
