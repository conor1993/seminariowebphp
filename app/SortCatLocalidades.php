<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortCatLocalidades extends Model
{
    protected $primaryKey = 'idLocalidad';
	protected $table ='SortCatLocalidades';
	protected $fillable = ['idEstado','idMunicipio','idLocalidad','Nombre','Cp',];
	public $timestamps = false;
}
