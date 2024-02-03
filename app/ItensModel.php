<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItensModel extends Model
{
    protected $table = 'itens';
    protected $fillable = ['item','ducates','platina'];
}
