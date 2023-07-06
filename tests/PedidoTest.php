<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use DatabaseTransactions;

    public function test_update_request_ok(): void
    {
        $response = $this->call('PUT', '/pedido/1', ['ativo' => 1]);
        $status = $response->status();
        $this->assertContains($status, array(200, 404), "HTTP status code must be 200 or 404");
    }

    public function test_update_request_error(): void
    {
        $response = $this->call('PUT', '/pedido/1', ['ativo' => 'aaa']);
        $this->assertResponseStatus(422, "HTTP status code must be 422.");
    }


    //Este método está comentado porque não está funcionando. Problemas com a lib GD
    //Para não parar o projeto por conta disso, comentei e segui sem ele
    //Não consegui testar o upload de imagem
    public function test_store_request_ok(): void
    {
        $response = $this->post(
            '/pedido', [
                'cliente_id' => 1,
                'produtos' => '[1, 2, 3]'
                ]
        );
        $this->assertResponseStatus(201, "HTTP status code must be 200.");
    }

    public function test_store_request_error(): void
    {
        $response = $this->post('/pedido', ['nome' => 'Produto teste', 'ativo' => 'aaa']);
        $this->assertResponseStatus(422, "HTTP status code must be 422.");
    }

    public function test_index_request_ok(): void
    {
        $response = $this->call('GET','/pedidos');
        $status = $response->status();
        $this->assertContains($status, array(200, 404), "HTTP status code must be 200 or 404");
    }

    public function test_index_request_error(): void
    {
        $response = $this->call('GET','/pedidosS');
        $status = $response->status();
        $this->assertContains($status, array(422, 404, 503), "HTTP status code must be 422, 404, 503");
    }

    public function test_show_request_ok(): void
    {
        $response = $this->call('GET','/pedido/1');
        $status = $response->status();
        $this->assertContains($status, array(200, 404), "HTTP status code must be 200 or 404");
    }

    public function test_show_request_error(): void
    {
        $response = $this->call('POST','/pedido/1');
        $status = $response->status();
        $this->assertContains($status, array(405), "HTTP status code must be 405");
    }
    
}
