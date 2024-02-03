<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioItensModel extends Model
{
    protected $table = 'inventario_itens';
    protected $primaryKey = 'id_item';
    protected $fillable = ['item','quantidade'];
}
