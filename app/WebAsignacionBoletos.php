<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebAsignacionBoletos extends Model
{
   	protected $primaryKey = 'IdSolicitud';
    protected $table='WebAsignacionBoletos';
    protected $fillable=['IdSolicitud','IdBoleto'];
    public $timestamps = false;
}
