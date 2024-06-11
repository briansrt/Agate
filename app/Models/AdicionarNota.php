<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdicionarNota extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigoadicionarnotas';
    public $incrementing = true; // Pon esto en true si es autoincremental
    protected $keyType = 'int'; // Cambia a 'string' si no es un entero
}
