<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class WarframeMarketController extends Controller
{
    public function fetchWarframeMarketData($platform, $itemName)
    {
        $url = "https://api.warframe.market/v1/items/{$itemName}/orders?include=item";
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'accept' => 'application/json',
                'Platform' => $platform,
            ],
        ]);
        $data = json_decode($response->getBody(), true);
        return response()->json($data);
    }
}
