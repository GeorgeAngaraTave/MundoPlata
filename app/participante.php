<?php

namespace MPlaneta;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = 'participantes';
    public $primaryKey  = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'cedula','edad', 'genero'];
}
