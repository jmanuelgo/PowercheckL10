<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPeso extends Model
{
    use HasFactory;
    protected $table = 'historial_pesos';
    protected $fillable = [
        'atleta_id',
        'peso',
        'fecha',
    ];
    protected $casts = [
        'fecha' => 'date',
    ];
    public function atleta()
    {
        return $this->belongsTo(Atleta::class);
    }
}
