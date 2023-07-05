<?php

namespace App\Http\Controllers;

use App\Models\PedidoProduto;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    private function store(int $pedido_id, int $produto_id) : bool
    {
        try{
            $store = PedidoProduto::create(['pedido_id'=>$pedido_id, 'produto_id' =>$produto_id]);
            if(!$store){
                return false;
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function salvarProdutos(int $pedido_id, array $produtos) : array
    {
        $soma = 0;
        $quantidade = 0;
        $produtos_adicionados = [];
        try{
            foreach($produtos as $produto_id){
                $produto = Produto::find($produto_id);
                if(!$produto){
                    continue;
                }
                if($this->store($pedido_id, $produto_id)){
                    $soma += $produto->preco;
                    $quantidade++;
                    array_push($produtos_adicionados, $produto);
                }
            }
        }catch(Exception $e){
            return array('soma'=>$soma, 'quantidade' => $quantidade,'produtos' => $produtos_adicionados, 'erro' => $e->getMessage());
        }
        
        return array('soma'=>$soma, 'quantidade' => $quantidade, 'produtos' => $produtos_adicionados);
    }

    public function buscarPorPedido(int $pedido_id) : array
    {
        $soma = 0;
        $quantidade = 0;
        $produtos_adicionados = [];

        try{
            $pedidoProdutos = PedidoProduto::where('pedido_id', $pedido_id)->get();
            if(!$pedidoProdutos){
                return array('soma'=>$soma, 'quantidade' => $quantidade,'produtos' => $produtos_adicionados);
            }

            foreach($pedidoProdutos as $pedidoProduto){
                $produto = Produto::find($pedidoProduto->produto_id);
                $soma += $produto->preco;
                $quantidade++;
                array_push($produtos_adicionados, $produto);
                unset($produto);
            }

        }catch(Exception $e){
            return array('soma'=>$soma, 'quantidade' => $quantidade,'produtos' => $produtos_adicionados, 'erro' => $e->getMessage());
        }
        return array('soma'=>$soma, 'quantidade' => $quantidade,'produtos' => $produtos_adicionados);
    }
}
