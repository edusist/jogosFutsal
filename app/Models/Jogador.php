<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    use HasFactory;

    protected $table = 'jogadores';


    protected $fillable = ['nome_jogador', 'posicao', 'presente', 'created_at', 'updated_at', 'nivel'];
}
