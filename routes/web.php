<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/','PrincipalController@index')->name('front-index');
Route::get('/adicionar-item-inventario/{id}','PrincipalController@adicionar')->name('front-adicionar');
Route::get('/obter-detalhes-de-venda/{id}','PrincipalController@venda')->name('front-venda');
Route::post('/remover-item-inventario','PrincipalController@remover')->name('front-remover');
Route::get('/fetch-warframe-market/{plataforma}/{item}', 'WarframeMarketController@fetchWarframeMarketData');
Route::get('/fetch-warframe-img/{plataforma}/{item}', 'WarframeMarketController@fetchWaframeMarketImg');


// Route::get('/images/{filename}', function ($filename) {
//     $path = storage_path('app/public/' . $filename);
    
//     if (!File::exists($path)) {
//         abort(404);
//     }

//     return response()->file($path);
// });