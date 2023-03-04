<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;
use JsonException;
use App\Dto\CryptoCurrencyDto;
use App\Interfaces\ICryptoCurrencyRepository;

class FetchCoinMarketCapCurrenciesUSDCommand extends Command
{
    protected $signature = 'fetch-coin-market-cap-currencies-usd';
    protected $description = 'Fetches and updates cryptocurrency data in USD using the CoinMarketCap API';

    private ICryptoCurrencyRepository $cryptoCurrencyRepository;

    public function __construct(ICryptoCurrencyRepository $cryptoCurrencyRepository)
    {
        parent::__construct();
        $this->cryptoCurrencyRepository = $cryptoCurrencyRepository;
    }

    public function handle(): void
    {
        $client = new Client();

        $url = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
            'start' => '1',
            'limit' => '200',
            'convert' => 'USD'
        ];

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => '8ccea18e-7753-4d44-83ff-1a188f12d343'
        ];

        $qs = http_build_query($parameters);
        $request = "{$url}?{$qs}";

        $response = $client->request('GET', $request, ['headers' => $headers]);

        try {
            $cryptoCurrencies = json_decode($response->getBody());
        } catch (JsonException $e) {
            throw new Exception('Failed to decode API JSON response : ' . $e->getMessage());
        }

        if (!isset($cryptoCurrencies->data)) {
            throw new Exception('API response structure is invalid');
        }

        foreach ($cryptoCurrencies->data as $currency) {
            try {
                $validator = Validator::make([
                    'symbol' => $currency->symbol,
                    'name' => $currency->name,
                    'price' => $currency->quote->USD->price,
                    'market_cap' => $currency->quote->USD->market_cap,
                    'percent_change_24h' => $currency->quote->USD->percent_change_24h
                ], [
                    'symbol' => 'string',
                    'name' => 'string',
                    'price' => 'numeric',
                    'market_cap' => 'numeric',
                    'percent_change_24h' => 'numeric'
                ]);

                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }

                $cryptoCurrencyDto = new CryptoCurrencyDto(
                    $currency->symbol,
                    $currency->name,
                    $currency->quote->USD->price,
                    $currency->quote->USD->market_cap,
                    $currency->quote->USD->percent_change_24h
                );

                $success = $this->cryptoCurrencyRepository->updateOrCreate($cryptoCurrencyDto);

                if (!$success) {
                    throw new Exception("Failed to insert or update record into the database");
                }
            } catch (ValidationException $e) {
                $errors = $e->validator->errors()->all();
                $this->error('Failed to save currency ' . $currency->symbol . ': ' . implode('; ', $errors));
            } catch (Exception $e) {
                $this->error('Failed to save currency ' . $currency->symbol . ': ' . $e->getMessage());
            }
        }
    }
}
