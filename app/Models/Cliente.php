<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome', 'email', 'telefone', 'data_nascimento', 'endereco', 'complemento', 'bairro', 'cep', 'ativo'];
}
