<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebCatBoletos extends Model
{
    protected $primaryKey = 'NumeroBoleto,IdSorteo';
	protected $table ='WebCatBoletos';
	protected $fillable = ['NumeroBoleto','Estatus','IdSorteo'];
    public $timestamps = false;
}
