<?php

use Illuminate\Database\Seeder;
use App\ItensModel;

class ItensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            ['nome' => 'Ember Prime: (Sistemas)', 'item' => 'ember_prime_systems', 'conjunto' => 1],
            ['nome' => 'Mirage Prime: (Sistemas)', 'item' => 'mirage_prime_systems', 'conjunto' => 2],
        ];
        foreach ($dados as $itens) {
            $item = new ItensModel();
            $item->item = $itens['item'];
            $item->nome = $itens['nome'];
            $item->conjunto = $itens['conjunto'];
            $item->save();
        }
    }
}
