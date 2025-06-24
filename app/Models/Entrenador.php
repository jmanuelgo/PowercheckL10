<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gimnasio_id',
        'foto',
        'especialidad',
        'experiencia',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gimnasio()
    {
        return $this->belongsTo(Gimnasio::class);
    }
    public function atletas()
    {
        return $this->hasMany(Atleta::class);
    }
}
