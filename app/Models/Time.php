<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{   protected $table = 'timesfutsal';
    use HasFactory;
    protected $fillable =  ['nome_time', 'created_at', 'updated_at','data_rodada', 'jogador_id'];
}
