<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebCatGestores extends Model
{
    
    protected $primaryKey = 'Id';
	protected $table ='WebCatGestores';
	protected $fillable = ['Nombre','ApellidoP','ApellidoM','Commission','IdCanaldistribucion'];
	public $timestamps = false;
}
