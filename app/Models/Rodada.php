<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rodada extends Model
{
    use HasFactory;

    protected $fillable =  ['data_rodada', 'user_id', 'jogador_id', 'timefutsal_id', 'created_at', 'updated_at'];
}
