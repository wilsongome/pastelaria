<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use Exception;
use Illuminate\Http\Request;

class PedidoController extends Controller
{

    public function getPedido(int $pedido_id)
    {
        try{
            $pedido = Pedido::find($pedido_id);
            if(!$pedido){
                return [];
            }

            $cliente = Cliente::find($pedido->cliente_id);
            $pedido->cliente = $cliente;

            $pedidoProdutoController = new PedidoProdutoController();
            $detalhamento = $pedidoProdutoController->buscarPorPedido($pedido->id);
            $pedido->detalhamento = $detalhamento;
            return $pedido;

        }catch(Exception $e){
            return [];
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'cliente_id' => 'required|integer',
            'produtos' => 'required|json'
        ]);

        try{
            $cliente = Cliente::find($request->cliente_id);
            if(!$cliente){
                return response()->json([], 400);  
            }
            $input_produtos = $request->all(['produtos']);
            $produtos = json_decode($input_produtos['produtos']);
            $pedido = Pedido::create(['cliente_id' => $request->cliente_id]);
            if(!$pedido){
                return response()->json([], 400);
            }
            $pedidoProdutoController = new PedidoProdutoController();
            $pedidoProdutos = $pedidoProdutoController->salvarProdutos($pedido->id, $produtos);
            if($pedidoProdutos["quantidade"] == 0){
                $pedido->delete();
                return response()->json([], 400);
            }
            $pedido->cliente = $cliente;
            $pedido->detalhamento = $pedidoProdutos;
            $pedidoEmailController = new PedidoEmailController();
            $pedidoEmailController->enviarEmail($pedido);
            return response()->json($pedido, 200);
        }catch(Exception $e){
            return response()->json([], 400);
        }
    }

    public function show(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        try{
            $pedido = $this->getPedido($request->id);
            $status = 200;
            if(!$pedido){
                $status = 404;
            }

            return response()->json($pedido, $status);
        }catch(Exception $e){
            return response()->json([], 400);
        }
       
    }

    public function update(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $this->validate($request, [
            'id' => 'required|integer',
            'ativo' => 'boolean'
        ]);

        try{
            $pedido = Pedido::find($request->id);
            if(!$pedido){
                return response()->json($pedido, 404);
            }
    
            $pedido->fill($request->all());
    
            if(!$pedido->save()){
                return response()->json($pedido, 400);
            }
            return response()->json($pedido, 200);
        }catch(Exception $e){
            return response()->json([], 400);
        }
       
    }

    public function index()
    {
        try{
            $pedidos = Pedido::where('ativo', 1)->get();
            $status = 200;
            if(!count($pedidos) > 0){
                $status = 404;
            }
            $pedidosDetalhados = [];
            foreach($pedidos as $pedido){
                $pedidoDetalhado = $this->getPedido($pedido->id);
                array_push($pedidosDetalhados, $pedidoDetalhado);
            }
            return response()->json($pedidosDetalhados, $status);
        }catch(Exception $e){
            return response()->json([], 400);
        }
    }

    public function delete(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        try{
            $pedido = Pedido::find($request->id);
            if(!$pedido){
                return response()->json($pedido, 404);
            }
            $pedido->ativo = 0;
            if(!$pedido->save()){
                return response()->json([], 400);
            }
            return response()->json([], 200);
        }catch(Exception $e){
            return response()->json([], 400);
        }
    }
}
