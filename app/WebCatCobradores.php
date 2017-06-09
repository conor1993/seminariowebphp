<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebCatCobradores extends Model
{

	protected $primaryKey = 'Id';
	protected $table ='WebCatCobradores';
	protected $fillable = ['Nombre','ApellidoP','ApellidoM','Commission','Serie'];
	public $timestamps = false;
	
}
