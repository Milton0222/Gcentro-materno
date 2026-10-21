<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class partos extends Model
{
    use HasFactory;

    protected $fillable=[
        'estado','tipo','obs','pacienteID'
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(pacientes::class, 'pacienteID');
    }

    public function criancas(): HasMany
    {
        return $this->hasMany(criancas::class, 'partoID');
    }
}
