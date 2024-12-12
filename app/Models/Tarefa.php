<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Projeto;

class Tarefa extends Model
{
    protected $table = 'tarefa';
    //

    protected $fillable = [
        'nome',
        'descricao',
        'completo',
        'prioridade',
        'user_id',
        'projeto_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projeto(): BelongsTo
    {
        return $this->belongsTo(Projeto::class);
    }
}
