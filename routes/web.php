<?php

use Illuminate\Support\Facades\Route;

Route::get('/','PrincipalController@index')->name('front-index');
Route::get('/adicionar-item-inventario/{id}','PrincipalController@adicionar')->name('front-adicionar');
Route::get('/obter-detalhes-de-venda/{id}','PrincipalController@venda')->name('front-venda');
Route::post('/remover-item-inventario','PrincipalController@remover')->name('front-remover');
Route::get('/fetch-warframe-market/{plataforma}/{item}', 'WarframeMarketController@fetchWarframeMarketData');