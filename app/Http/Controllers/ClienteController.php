<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function create(Request $request)
    {
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
