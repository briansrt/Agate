<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaña extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigocampana';
    public $incrementing = true; // Pon esto en true si es autoincremental
    protected $keyType = 'int'; // Cambia a 'string' si no es un entero
    
}

