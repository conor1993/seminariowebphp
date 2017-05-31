<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebCatCanalesdistribucion extends Model
{
    protected $primaryKey = 'Id';
	protected $table ='WebCatCanalesdistribucion';
	protected $fillable = ['Nombre','Comision'];
    public $timestamps = false;
}
