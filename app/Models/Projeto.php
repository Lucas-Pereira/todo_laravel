<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projeto extends Model
{

    protected $table = 'projeto';

    protected $fillable = [
        'nome'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tarefa(): HasMany{
        return $this->hasMany(Tarefa::class);
    }
}
