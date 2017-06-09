<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortCatEstados extends Model
{

    protected $primaryKey = 'id';
	protected $table ='SortCatEstados';
	protected $fillable = ['Nombre','Abreviacion'];
	public $timestamps = false;
	
}
