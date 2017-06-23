<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebFolioSolicitudes extends Model
{
	
    protected $primary='IdSorteo';
    protected $table='WebFolioSolicitudes';
    protected $fillable=['IdSorteo','Consecutivo'];
    public $timestamps = false;

}
