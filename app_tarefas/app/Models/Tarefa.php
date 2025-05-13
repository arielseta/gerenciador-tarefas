<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'vencimento',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}