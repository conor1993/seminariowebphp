<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebCatSorteo extends Model
{

	protected $primaryKey = 'Id';
	protected $table ='WebCatSorteo';
	protected $fillable = ['Nombre','Precio','NumeroPorBoleto','Fecha','FechaLimite','CantidadBoletos'];
	public $timestamps = false;

}
