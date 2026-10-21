<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class criancas extends Model
{
    use HasFactory;

    protected $fillable=[
        'nome','dataParto',
        'peso','hora','genero','partoID'
    ];

    public function parto(): BelongsTo
    {
        return $this->belongsTo(partos::class, 'partoID');
    }
}
