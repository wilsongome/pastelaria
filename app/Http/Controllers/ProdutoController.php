<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProdutoController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'preco' => 'required|decimal:2',
            'foto' => 'required|image|mimes:jpg,jpeg,png,gif',
            'tipo_produto_id' => 'required|integer',
        ]);

        try{
            $foto = $request->file('foto');
            $nomeArquivo = time()."_".$foto->getClientOriginalName();
            $foto->move('fotos', $nomeArquivo);
            $url = URL::asset('fotos/'.$nomeArquivo);
            $parameters = $request->all();
            $parameters['foto'] = $url;
            
            $produto = Produto::create($parameters);
            if(!$produto){
                return response()->json([], 400);
            }
            return response()->json($produto, 200);
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
            $produto = Produto::find($request->id);
            $status = 200;
            if(!$produto){
                $status = 404;
            }
            return response()->json($produto, $status);
        }catch(Exception $e){
            return response()->json([], 400);
        }
       
    }

    public function update(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $this->validate($request, [
            'id' => 'required|integer',
            'nome' => 'max:255',
            'email' => 'email|unique:Produtos|max:255',
            'telefone' => 'max:11',
            'data_nascimento' => 'date|date_format:Y-m-d|max:10',
            'endereco' => 'max:255',
            'complemento' => 'max:255',
            'bairro' => 'max:255',
            'cep' => 'max:9',
            'ativo' => 'boolean',
        ]);

        try{
            $produto = Produto::find($request->id);
            if(!$produto){
                return response()->json($produto, 404);
            }
    
            $produto->fill($request->all());
    
            if(!$produto->save()){
                return response()->json($produto, 400);
            }
            return response()->json($produto, 200);
        }catch(Exception $e){
            return response()->json([], 400);
        }
       
    }

    public function index()
    {
        try{
            $produtos = Produto::where('ativo', 1)->get();
            $status = 200;
            if(!count($produtos) > 0){
                $status = 404;
            }
            return response()->json($produtos, $status);
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
            $produto = Produto::find($request->id);
            if(!$produto){
                return response()->json($produto, 404);
            }
            $produto->ativo = 0;
            if(!$produto->save()){
                return response()->json([], 400);
            }
            return response()->json([], 200);
        }catch(Exception $e){
            return response()->json([], 400);
        }
    }
}
