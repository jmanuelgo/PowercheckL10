<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gimnasio extends Model
{
    use HasFactory;
    protected $table = 'gimnasios';
    protected $fillable = [
        'nombre',
        'ubicacion',
        'logo',
        'celular',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function setNombreAttribute($valor)
    {
        $this->attributes['nombre'] = ucfirst(trim($valor));
    }
}
