<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItensModel;
use App\InventarioItensModel;
use App\RegistroVendasModel;


class PrincipalController extends Controller
{
    public function index(){
        $itens = ItensModel::all();
        $estoque = InventarioItensModel::all(); 
        return view('front.index', ['itens' => $itens, 'estoque' => $estoque]);
    }

    public function adicionar($id){
        $itens = ItensModel::find($id);
        if (InventarioItensModel::where('id_item', $id)->exists()) { 
            InventarioItensModel::where('id_item', $id)->increment('quantidade', 1);
        } else {
            $inventario = new InventarioItensModel(); 
            $inventario->id_item = $itens->id;
            $inventario->nome = $itens->nome;
            $inventario->item = $itens->item;
            $inventario->save();
        }
        return redirect()->route('front-index');
    }
    public function venda($id){
        $detalhes= InventarioItensModel::find($id); 
        return response()->json(['detalhes' => $detalhes]);
    }

    public function remover(Request $req){
        if($req->quantidade == '0'){
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('quantidade', 'Você não pode realizar uma venda 0 em quantidade.');
            return redirect()->back()->withErrors($errors)->withInput($req->all());
        }
        $regras = [
            'quantidade' => 'min:1',
            'preco' => 'min:1',
        ];
        $feedback = [
            'quantidade.min' => 'A quantidade deve ter no mínimo de 1 unidade',
            'preco.min' => 'O preço da venda deve ser maior que zero',
        ];
        $req->validate($regras, $feedback);
        $estoque = $req->estoque - $req->quantidade;
        if ($estoque < 0) {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('estoque', 'O estoque não pode ser menor que a quantidade vendida.');
            return redirect()->back()->withErrors($errors)->withInput($req->all());
        }
        $inventario = InventarioItensModel::find($req->id);
        if ($inventario) {
            $inventario->quantidade = $estoque;
            $inventario->quantidade == 0 ? $inventario->forceDelete() : $inventario->save();
            $registro = new RegistroVendasModel();
            $registro->item_vendido = $req->item;
            $registro->quantidade_vendida = $req->quantidade;
            $registro->estoque_atual = $estoque;
            $registro->preco_vendido = $req->preco;
            $registro->save();
            return redirect()->route('front-index');
        } else {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('item', 'O item não foi encontrado no sistema.');
            return redirect()->back()->withErrors($errors)->withInput($req->all());
        }
    }
}
