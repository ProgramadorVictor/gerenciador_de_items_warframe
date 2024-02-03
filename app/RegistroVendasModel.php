<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroVendasModel extends Model
{
    protected $table = 'registros_de_vendas';
    protected $fillable = ['item_Vendido','quantidade_vendida','preco_vendido','ultimo_estoque'];
}
