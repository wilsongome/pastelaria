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
        Schema::create('pedido_produtos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pedido_id', false, true);
            $table->foreign("pedido_id")->references("id")->on("pedidos")->onDelete("RESTRICT");
            $table->bigInteger('produto_id', false, true);
            $table->foreign("produto_id")->references("id")->on("produtos")->onDelete("RESTRICT");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido_produtos', function (Blueprint $table) {
            Schema::drop('pedido_produtos');
        });
    }
};
