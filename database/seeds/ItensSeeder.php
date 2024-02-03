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
            ['item' => 'Ember Prime: (Diagrama)', 'conjunto' => 1],
            ['item' => 'Ember Prime: (Neurovisor)', 'conjunto' => 1],
            ['item' => 'Ember Prime: (Chassi)', 'conjunto' => 1],
            ['item' => 'Ember Prime: (Sistema)', 'conjunto' => 1],
            ['item' => 'Frost Prime: (Diagrama)', 'conjunto' => 2],
            ['item' => 'Frost Prime: (Neurovisor)', 'conjunto' => 2],
            ['item' => 'Frost Prime: (Chassi)', 'conjunto' => 2],
            ['item' => 'Frost Prime: (Sistema)', 'conjunto' => 2],
            ['item' => 'Rhino Prime: (Diagrama)', 'conjunto' => 3],
            ['item' => 'Rhino Prime: (Neurovisor)', 'conjunto' => 3],
            ['item' => 'Rhino Prime: (Chassi)', 'conjunto' => 3],
            ['item' => 'Rhino Prime: (Sistema)', 'conjunto' => 3],
            ['item' => 'Nova Prime: (Diagrama)', 'conjunto' => 4],
            ['item' => 'Nova Prime: (Neurovisor)', 'conjunto' => 4],
            ['item' => 'Nova Prime: (Chassi)', 'conjunto' => 4],
            ['item' => 'Nova Prime: (Sistema)', 'conjunto' => 4],
            ['item' => 'Ash Prime: (Diagrama)', 'conjunto' => 5],
            ['item' => 'Ash Prime: (Neurovisor)', 'conjunto' => 5],
            ['item' => 'Ash Prime: (Chassi)', 'conjunto' => 5],
            ['item' => 'Ash Prime: (Sistema)', 'conjunto' => 5],
            ['item' => 'Banshee Prime: (Diagrama)', 'conjunto' => 6],
            ['item' => 'Banshee Prime: (Neurovisor)', 'conjunto' => 6],
            ['item' => 'Banshee Prime: (Chassi)', 'conjunto' => 6],
            ['item' => 'Banshee Prime: (Sistema)', 'conjunto' => 6],
            ['item' => 'Chroma Prime: (Diagrama)', 'conjunto' => 7],
            ['item' => 'Chroma Prime: (Neurovisor)', 'conjunto' => 7],
            ['item' => 'Chroma Prime: (Chassi)', 'conjunto' => 7],
            ['item' => 'Chroma Prime: (Sistema)', 'conjunto' => 7],
            ['item' => 'Excalibur Prime: (Diagrama)', 'conjunto' => 8],
            ['item' => 'Excalibur Prime: (Neurovisor)', 'conjunto' => 8],
            ['item' => 'Excalibur Prime: (Chassi)', 'conjunto' => 8],
            ['item' => 'Excalibur Prime: (Sistema)', 'conjunto' => 8],
        ];
        
        foreach ($dados as $itens) {
            $item = new ItensModel();
            $item->item = $itens['item'];
            $item->conjunto = $itens['conjunto'];
            $item->save();
        }
    }
}
