<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebAsignacionCobrador extends Model
{
    protected $primaryKey = 'IdCobrador';
    protected $table='WebAsignacionCobrador';
    protected $fillable=['IdCobrador','IdColaborador'];
    public $timestamps = false;
}
