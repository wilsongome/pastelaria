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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->char('nome', 255);
            $table->decimal('preco');
            $table->char('foto', 255);
            $table->bigInteger('tipo_produto_id', false, true);
            $table->foreign("tipo_produto_id")->references("id")->on("tipo_produtos")->onDelete("RESTRICT");
            $table->boolean('ativo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            Schema::drop('produtos');
        });
    }
};
