<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class pacientes extends Model
{
    use HasFactory;

    protected $fillable=[
        'nome','dataNascimento','genero',
        'morada','contacto',
        'tipoPaciente','estado','saude'
    ];

    public function consultas(): HasMany
    {
        return $this->hasMany(consultas::class, 'pacienteID');
    }

    public function partos(): HasMany
    {
        return $this->hasMany(partos::class, 'pacienteID');
    }

    public function planeamentos(): HasMany
    {
        return $this->hasMany(Planeamento::class, 'pacienteID');
    }
}
