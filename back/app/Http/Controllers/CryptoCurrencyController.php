<?php

namespace App\Http\Controllers;

use App\Interfaces\ICryptoCurrencyRepository;
use Illuminate\Http\Request;

class CryptoCurrencyController extends Controller
{
    private ICryptoCurrencyRepository $cryptoCurrencyRepository;

    public function __construct(ICryptoCurrencyRepository $cryptoCurrencyRepository)
    {
        $this->cryptoCurrencyRepository = $cryptoCurrencyRepository;
    }

    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $perPage = $request->input('perPage', 100);

        $query = $this->cryptoCurrencyRepository->findByTermOrAllAndPaginate($searchTerm, $perPage);

        return response()->json($query);
    }
}
