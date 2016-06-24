<?php

namespace MPlaneta;

use Illuminate\Database\Eloquent\Model;

class participante extends Model
{
    protected $table = 'my_flights';
    public $primaryKey  = 'id';
    public $timestamps = false;
}
