<?php

namespace Database\Seeders;

use App\Models\TipoProduto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_produtos')->delete();
        TipoProduto::create(['id' => 1, 'nome'=>"Pastel"]);
        TipoProduto::create(['id' => 2, 'nome'=>"Salgado"]);
        TipoProduto::create(['id' => 3, 'nome'=>"Bebida"]);
    }
}
