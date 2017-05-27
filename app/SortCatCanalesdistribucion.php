<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortCatCanalesdistribucion extends Model
{   
	protected $primaryKey = 'Id';
	protected $table ='SortCatCanalesdistribucion';
	protected $fillable = ['Nombre','Comision'];
    public $timestamps = false;
}
