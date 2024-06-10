<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposAnuncio extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigotiposanuncio';
    public $incrementing = true; // Pon esto en true si es autoincremental
    protected $keyType = 'int'; // Cambia a 'string' si no es un entero
}
