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
            if($orders['user']['status'] == 'ingame' && $orders['order_type'] == 'sell'){
                $data[] = $orders;
            }
        }
        return response()->json($data);
    }
    public function fetchWaframeMarketImg($plataforma, $item) {
        // $array = explode(',', $item);
        // $itens = $array[0];
        // $results = [];
        // foreach ($array as $itens) {
        //     $url = "https://api.warframe.market/v1/items/{$itens}";
        //     $client = new Client();
        //     $response = $client->request('GET', $url, [
        //         'headers' => [
        //             'accept' => 'application/json',
        //             'Platform' => $plataforma,
        //         ],
        //     ]);
        //     $result = json_decode($response->getBody(), true);
        //     $results[] = $result;
        // }
        $array = explode(',', $item);
        $itens = $array[0];
        $url = "https://api.warframe.market/v1/items/{$itens}";
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'accept' => 'application/json',
                'Platform' => $plataforma,
            ],
        ]);
        $results = json_decode($response->getBody(), true);
        $contador = count($results['payload']['item']['items_in_set']);
        $imagens = [];
        for ($i = 0; $i < $contador - 1; $i++) {
            // Obtém a URL da imagem para cada item
            $imageUrl = $results['payload']['item']['items_in_set'][$i]['sub_icon'];
            // Adiciona a URL da imagem ao array de imagens
            $imagens[] = $imageUrl;
        }
        return response()->json($results);
    }
}
