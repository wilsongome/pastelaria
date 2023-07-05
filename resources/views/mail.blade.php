<h3>Oi, {{ $cliente_nome }}!</h3>
<p>Confirmamos o seu pedido ID: <b>{{$pedido_id}}</b> </p>
<h4>Segue o detalhamento:</h4>

<p><b>Valor total:</b> R$ {{$pedido_total}}</p>
<p><b>Qtd. de produtos:</b> {{$quantidade_produtos}}</p>
<p><b>Endereço de entrega:</b> {{$cliente_endereco}}</p>
<h4>Produtos:</h4>

<ul>
    @foreach($produtos as $produto)
    <li>
        <label>R$ {{number_format($produto->preco, 2, ',','.')}}</label> | <label><b>{{$produto->nome}}</b></label>
    </li>
    @endforeach
</ul>

<p>Obrigado e volte sempre!</p>