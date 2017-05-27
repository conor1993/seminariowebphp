<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatPaises extends Model
{
    
    protected $table ='CatPaises';
    protected $fillable = ['Nombre'];
    public $timestamps = false;

}
