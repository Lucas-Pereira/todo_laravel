<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Projeto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use  Illuminate\Foundation\Auth\User as Authenticatable;

class Tarefa extends Authenticatable

{
    use HasFactory, Notifiable, HasApiTokens;
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
