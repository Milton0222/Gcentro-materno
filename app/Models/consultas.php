<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class consultas extends Model
{
    use HasFactory;
    protected $fillable=[
        'dataConsulta',
        'doutor','tipoConsulta',
        'valor','pacienteID','hora',
        'queixaPrincipal','pressaoArterial','frequenciaCardiaca',
        'frequenciaRespiratoria','temperatura','saturacaoOxigenio',
        'peso','altura','idadeGestacionalSemanas','batimentosFetais',
        'classificacaoRisco','observacoesTriagem'
    ];

    protected $casts = [
        'temperatura' => 'decimal:1',
        'saturacaoOxigenio' => 'decimal:1',
        'peso' => 'decimal:2',
        'altura' => 'decimal:2',
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(pacientes::class, 'pacienteID');
    }
}
