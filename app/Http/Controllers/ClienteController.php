<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function create(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:clientes|max:255',
            'telefone' => 'required|max:11',
            'data_nascimento' => 'required|date|date_format:Y-m-d|max:10',
            'endereco' => 'required|max:255',
            'complemento' => 'max:255',
            'bairro' => 'required|max:255',
            'cep' => 'required|max:9',
            'ativo' => 'boolean',
        ]);

        try{
            $cliente = Cliente::create($request->all());
            if(!$cliente){
                return response()->json([], 400);
            }
            return response()->json($cliente, 200);
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
            $cliente = Cliente::find($request->id);
            $status = 200;
            if(!$cliente){
                $status = 404;
            }
            return response()->json($cliente, $status);
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
            'email' => 'email|unique:clientes|max:255',
            'telefone' => 'max:11',
            'data_nascimento' => 'date|date_format:Y-m-d|max:10',
            'endereco' => 'max:255',
            'complemento' => 'max:255',
            'bairro' => 'max:255',
            'cep' => 'max:9',
            'ativo' => 'boolean',
        ]);

        try{
            $cliente = Cliente::find($request->id);
            if(!$cliente){
                return response()->json($cliente, 404);
            }
    
            $cliente->fill($request->all());
    
            if(!$cliente->save()){
                return response()->json($cliente, 400);
            }
            return response()->json($cliente, 200);
        }catch(Exception $e){
            return response()->json([], 400);
        }
       
    }

    public function index()
    {
        try{
            $clientes = Cliente::where('ativo', 1)->get();
            $status = 200;
            if(!count($clientes) > 0){
                $status = 404;
            }
            return response()->json($clientes, $status);
        }catch(Exception $e){
            return response()->json([], 400);
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        try{
            $cliente = Cliente::find($request->id);
            if(!$cliente){
                return response()->json($cliente, 404);
            }
            if(!$cliente->delete()){
                return response()->json([], 400);
            }
            return response()->json([], 200);
        }catch(Exception $e){
            return response()->json([], 400);
        }
    }
}
