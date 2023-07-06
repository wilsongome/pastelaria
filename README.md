# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

> **Note:** In the years since releasing Lumen, PHP has made a variety of wonderful performance improvements. For this reason, along with the availability of [Laravel Octane](https://laravel.com/docs/octane), we no longer recommend that you begin new projects with Lumen. Instead, we recommend always beginning new projects with [Laravel](https://laravel.com).

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Sobre a aplicação
Trata-se de uma aplicação para geração de pedidos em uma Pastelaria. Ela contém apenas o Backend, disponibilizando as APIs.
Basicamente você tem 3 entidades principais na aplicação (Cliente, Produtos, Pedidos)
Ao gerar um pedido, ela vai disparar um e-mail com os dados do pedido para o e-mail cadastrado do cliente.


## Como configurar a aplicação (Rodando Direto na Máquina)
Uma vez clonado o repositório, precisamos preparar a aplicação antes da execução

1) Executar o composer para baixar os pacotes
```composer update/install```

2) Criar um banco de dados no MySQL para a aplicação, exemplo: pastelaria
```create schema pastelaria;```
Criar um usuários com permissões para criar tabelas, e também os CRUDS no banco recém criado

3) Criar um arquivo .env a partir do arquivo .env.example na raíz da aplicação, e preencher as informações de acesso ao banco de dados e também do e-mail (A aplicação dispara e-mails por SMTP)
Se estiver no Linux, então:
```cp .env.example .env```

4) Executar o comando do ARTISAN para gerar as tabelas
```php artisan migrate```

5) Executar o comando do ARTISAN para gerar os SEEDs (Tabela tipo de produtos pré definidos)
(id:1 = Pastel, id:2 = Salgado, id:3 = Bebida)
```php artisan db:seed```

## Como executar a aplicação
Pode executar essa aplicação de duas formas simples:
1) Utlizando o serviço do PHP e definindo a porta, conforme abaixo
```php -S localhost:80 -t public```

2) Ajustando o VIRTUAL HOST do Apache
 - Habilitar o MOD REWRITE do Apache
 - Alterar o Virtual host, apontando para a aplicação conforme exemplo abaixo
 - Reiniciar o apache (restart / reload) 
 ```service httpd restart``` ou ```service apache2 restart```
 
 Exemplo:
 ```
 <VirtualHost *:80>
        # The ServerName directive sets the request scheme, hostname and port that
        # the server uses to identify itself. This is used when creating
        # redirection URLs. In the context of virtual hosts, the ServerName
        # specifies what hostname must appear in the request's Host: header to
        # match this virtual host. For the default virtual host (this file) this
        # value is not decisive as it is used as a last resort host regardless.
        # However, you must set it for any further virtual host explicitly.
        #ServerName www.example.com

        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/pastelaria/public

        # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
        # error, crit, alert, emerg.
        # It is also possible to configure the loglevel for particular
        # modules, e.g.
        #LogLevel info ssl:warn

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        # For most configuration files from conf-available/, which are
        # enabled or disabled at a global level, it is possible to
        # include a line for only one particular virtual host. For example the
        # following line enables the CGI configuration for this host only
        # after it has been globally disabled with "a2disconf".
        #Include conf-available/serve-cgi-bin.conf
</VirtualHost>
```

 ## Como configurar a aplicação (Docker)
 
 Para rodar a aplicação no Docker, siga os seguintes passos, uma vez que já tenha clonado o repositorio:

 1) Certifique-se de ter o Docker e o Docker Compose instalados em sua máquina

 2) Navegue até o diretório raiz da aplicação

 3) Execute: 
  - docker compose up --build -d
  - Aguarde até que que a operação seja completada totalmente, na primeira execução pode levar alguns minutos
  - Se precisar parar os containers e quiser executar novamente de forma mais rápida, apenas use o comando docker compose up -d

  4) Com os serviços em execução, precisaremos configurar a aplicação com os seguintes passos:
  - ```docker exec webservice cp .env.example .env``` (Para criar o .env da aplicação)
  - ```docker exec webservice composer install``` (Para instalar as dependências)
  - ```docker exec webservice chown -R www-data:www-data /var/www/html``` (Para ajustar permissões)
  - ```docker exec webservice chmod 775 -R /var/www/html``` (Para ajustar permissões)
  - ```docker exec webservice php artisan migrate``` (Para criar as tabelas no banco de dados)
  - ```docker exec webservice php artisan db:seed``` (Para criar registros iniciais da tabela)

  5) Se seguiu todos os passos corretamente, a aplicação deve estar no ar. Utilize a Collection do POSTMAN para testar a aplicação, atendando para a porta de execução.
  - Exemplo: Por padrão está na 8080 então fazer a chamada para (http://localhost:8080/produto/), se alterar para a porta 80, então não precisa informar (http://localhost/produto/)

IMPORTANTE: O banco de dados será APAGADO a cada reinicialização da aplicação, então caso queira manter os dados, basta descomentar o seguinte trecho do arquivo docker-compose.yml
#volumes:
   **#  - ./db:/var/lib/mysql**


## Como testar a aplicação
1) A aplicação não possui frontend, apenas APIs. Logo precisará testar chamando essas APIs autilizando algum cliente, e para facilitar eu deixei pronto uma collection do POSTMAN na raíz do projeto, chamado: 
**Pastelaria - LUMEN.postman_collection.json**
...que contém todos os métodos disponíveis na aplicação, seguindo o padrão REST.

2) A aplicação também possui testes automatizados, e para executar, basta rodar o seguinte comando, estando no diretório raíz da aplicação:
 vendor/bin/phpunit


## Endpoints da aplicação

Todas as APIs retornarão os registros no formato JSON
Métodos de busca "GET" sempre devem retornar 200 ou 404

Métodos de atualização/exclusão retornam 200 ou algum código de erro 4xx. Podem retornar 404 caso não encontre o registro também

Métodos de criação retornarão 201 ou algum código de erro 4xx

# Clientes
**GET**
http://localhost/cliente/
Retorna uma lista de clientes

**GET**
http://localhost/cliente/{id}
Retorna um cliente dado o ID, ou vazio caso não encontre

**PUT**
http://localhost/cliente/{id}
Atualiza um cliente, dado o ID

**POST**
http://localhost/cliente/
Cria um novo cliente na aplicação

**DELETE**
http://localhost/cliente/{id}
Deleta um cliente, dado o ID

# Produtos
**GET**
http://localhost/produto/
Retorna uma lista de produtos

**GET**
http://localhost/produto/{id}
Retorna um produto dado o ID, ou vazio caso não encontre

**PUT**
http://localhost/produto/{id}
Atualiza um produto, dado o ID

**POST**
http://localhost/produto/
Cria um novo produto na aplicação

**DELETE**
http://localhost/produto/{id}
Deleta um produto, dado o ID


# Pedidos
**GET**
http://localhost/pedido/
Retorna uma lista de pedidos

**GET**
http://localhost/pedido/{id}
Retorna um pedido dado o ID, ou vazio caso não encontre

**PUT**
http://localhost/pedido/{id}
Atualiza um pedido, dado o ID

**POST**
http://localhost/pedido/
Cria um novo pedido na aplicação

**DELETE**
http://localhost/pedido/{id}
Deleta um pedido, dado o ID


### Ficou alguma dúvida?
 Caso tenham alguma dúvida em executar a aplicação, podem me chamar: **wilsongome@gmail.com**



