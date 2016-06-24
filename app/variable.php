<?php

namespace MPlaneta;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = 'variables';
     protected $fillable = ['id_participante', 'variable','mes', 'resultado','cumplimiento','cumplimiento'];
}
