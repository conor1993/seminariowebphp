<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BCatAutores extends Model
{
	

    protected $table ='BCatAutores';
    protected $fillable = ['Nombre','IdPais'];
    public $timestamps = false;

}
