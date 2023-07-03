<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->char('nome', 255);
            $table->char('email', 255)->unique();
            $table->char('telefone', 11);
            $table->date('data_nascimento');
            $table->char('endereco', 255);
            $table->char('complemento', 255);
            $table->char('bairro', 255);
            $table->char('cep', 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            Schema::drop('clientes');
        });
    }
};
