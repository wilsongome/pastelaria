<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use DatabaseTransactions;

    public function test_update_request_ok(): void
    {
        $response = $this->call('PUT', '/cliente/1', ['nome' => 'Cliente teste']);
        $status = $response->status();
        $this->assertContains($status, array(200, 404), "HTTP status code must be 200 or 404");
    }

    public function test_update_request_error(): void
    {
        $response = $this->call('PUT', '/cliente/1', ['ativo' => 'aaa']);
        $this->assertResponseStatus(422, "HTTP status code must be 422.");
    }

    public function test_store_request_ok(): void
    {
        $response = $this->post(
            '/cliente', 
            [
                'nome' => 'Cliente teste', 
                'email' => 'teste@teste.com',
                'telefone' => '11989995982',
                'data_nascimento' => '2023-01-01',
                'endereco' => 'Rua teste, 21',
                'complemento' => 'ap 22',
                'cep' => '08295-410',
                'bairro' => 'Itaquera',
            ]);
        $this->assertResponseStatus(200, "HTTP status code must be 200.");
    }

    public function test_store_request_error(): void
    {
        $response = $this->post('/cliente', ['nome' => 'Cliente teste', 'email' => 'teste@teste.com']);
        $this->assertResponseStatus(422, "HTTP status code must be 422.");
    }

    public function test_index_request_ok(): void
    {
        $response = $this->call('GET','/clientes');
        $status = $response->status();
        $this->assertContains($status, array(200, 404), "HTTP status code must be 200 or 404");
    }

    public function test_index_request_error(): void
    {
        $response = $this->call('GET','/clientesS');
        $status = $response->status();
        $this->assertContains($status, array(422, 404, 503), "HTTP status code must be 422 or 422");
    }

    public function test_show_request_ok(): void
    {
        $response = $this->call('GET','/cliente/1');
        $status = $response->status();
        $this->assertContains($status, array(200, 404), "HTTP status code must be 200 or 404");
    }
    
}
