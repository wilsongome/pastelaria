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


## Como configurar a aplicação
Uma vez clonado o repositório, precisamos preparar a aplicação antes da execução

1) Executar o composer para baixar os pacotes
composer update/install

2) Criar um banco de dados no MySQL para a aplicação, exemplo: pastelaria
create schema pastelaria;
Criar um usuários com permissões para criar tabelas, e também os CRUDS no banco recém criado

3) Criar um arquivo .env a partir do arquivo .env.example na raíz da aplicação, e preencher as informações de acesso ao banco de dados e também do e-mail (A aplicação dispara e-mails por SMTP)

4) Executar o comando do ARTISAN para gerar as tabelas
php artisan migrate

5) Executar o comando do ARTISAN para gerar os SEEDs
php artisan db:seed

## Como executar a aplicação
Pode executar essa aplicação de duas formas simples:
1) Utlizando o serviço do PHP e definindo a porta, conforme abaixo
php -S localhost:8000 -t public

2) Ajustando o VIRTUAL HOST do Apache
 - Habilitar o MOD REWRITE do Apache
 - Alterar o Virtual host, apontando para a aplicação conforme exemplo abaixo
 - Reiniciar o apache (restart / reload) service httpd ou service apache2 restart/reload
 
 Exemplo:
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

## Como testar a aplicação
1) A aplicação não possui frontend, apenas APIs. Logo precisará testar chamando essas APIs autilizando algum cliente, e para facilitar eu deixei pronto uma collection do POSTMAN na raíz do projeto, chamado: Pastelaria - LUMEN.postman_collection.json que contém todos os métodos disponíveis na aplicação, seguindo o padrão REST.

2) A aplicação também possui testes automatizados, e para executar, basta rodar o seguinte comando, estando no diretório raíz da aplicação:
 ./vendor/bin/phpunit

 ## Docker 
 Embora estivesse no requisito, infelizmente ainda não consegui colocar a aplicação para rodar em container, o que facilitaria bastante nos testes. Isso foi devido a falta de tempo mesmo.
 
 De toda forma, e independente do resultado do processo, pretendo seguir com esse projeto até o fim para que fique no meu GIT como portifólio, inclusive melhorando a arquitetura.

 Caso tenham alguma dúvida em executar a aplicação, não exitem em me chamar: wilsongome@gmail.com

 "Feito é melhor do que perfeito!"
 Autor: Desconhecido



