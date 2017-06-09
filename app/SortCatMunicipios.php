<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortCatMunicipios extends Model
{
    protected $primaryKey = 'id';
	protected $table ='SortCatMunicipios';
	protected $fillable = ['idEstado','Nombre'];
	public $timestamps = false;
}
