<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class WarframeMarketController extends Controller
{
    public function fetchWarframeMarketData($plataforma, $item)
    {
        $url = "https://api.warframe.market/v1/items/{$item}/orders?include=item";
        $client = new Client();
        $req = $client->request('GET', $url, [
            'headers' => [
                'accept' => 'application/json',
                'Platform' => $plataforma,
            ],
        ]);
        $data = [];
        $filtrar = json_decode($req->getBody(), true);
        foreach($filtrar['payload']['orders'] as $orders){
            if($orders['user']['status'] == 'ingame'){
                $data[] = $orders;
            }
        }
        return response()->json($data);
    }
}
