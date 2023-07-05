<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PedidoEmailController extends Controller
{
    private $to;
    private $to_name;

    public function enviarEmail(Pedido $pedido) : void 
    {
        $this->to = $pedido->cliente->email;
        $this->to_name = $pedido->cliente->nome;
        $dados = [
            'cliente_nome' => $pedido->cliente->nome,
            'cliente_email' => $pedido->cliente->email,
            'cliente_endereco' => $pedido->cliente->endereco. ", ".$pedido->cliente->bairro.", ".$pedido->cliente->cep,
            'pedido_id' => $pedido->id,
            'pedido_total' => number_format($pedido->detalhamento['soma'], 2, ',', '.'),
            'quantidade_produtos' => $pedido->detalhamento['quantidade'],
            'produtos' => $pedido->detalhamento['produtos']
        ];

        Mail::send('mail', $dados, function($message) {
            $message->to($this->to, $this->to_name)->subject('Pastelaria - Confirmação de pedido!');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        
        $this->to = null;
        $this->to_name = null;
    }
}
