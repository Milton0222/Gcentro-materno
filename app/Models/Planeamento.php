<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Planeamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'dataPlaneamento',
        'metodo',
        'estado',
        'proximaData',
        'observacoes',
        'pacienteID',
    ];

    protected $casts = [
        'dataPlaneamento' => 'date',
        'proximaData' => 'date',
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(pacientes::class, 'pacienteID');
    }
}
